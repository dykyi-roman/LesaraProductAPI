<?php

namespace Dykyi\Application;

use Ajgl\SimpleBus\Message\Bus\CatchReturnMessageBus;
use Ajgl\SimpleBus\Message\Bus\Middleware\CatchReturnMessageBusSupportingMiddleware;
use Ajgl\SimpleBus\Message\Handler\DelegatesToMessageHandlerAndCatchReturnMiddleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;
use Dykyi\Application\Mapper\CSVFileMapper;
use Dykyi\Domain\Message\Command\ProductCreateCommand;
use Dykyi\Domain\Message\CommandHandler\ProductCreateHandler;
use Dykyi\Domain\Message\Query\ProductListQuery;
use Dykyi\Domain\Message\QueryHandler\ProductListQueryHandler;
use Dykyi\Infrastructure\Repository\Storage\AWSStorageProvider;
use Dykyi\Infrastructure\Service\ProductCreateService;
use Dykyi\Infrastructure\Service\ProductListService;
use GuzzleHttp\Client as GuzzleClient;
use Interop\Container\ContainerInterface;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use SimpleBus\Command\Bus\CommandBus;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use Stash\Pool as Cache;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Whoops\Run as Whoops;
use Zend\ServiceManager\ServiceManager;

/**
 * Class Containers
 *
 * @package Dykyi\Application
 */
class Containers
{
    /**
     *
     * @var ServiceManager null
     */
    private $handles;

    public function __construct()
    {
        $this->handles = new ServiceManager(
            [
                'factories' => [
                    'Config' => function (): array {
                        $envConfig = (new Dotenv(__DIR__ . '/../../'))->load();

                        $keys = [];
                        foreach ($envConfig as $item) {
                            $elements = explode('=', $item);
                            $keys[$elements[0]] = $elements[1];
                        }
                        return $keys;
                    },

                    'Security' => function (): array {
                        $keyfile = __DIR__ . '/../../.keyfile';
                        $parser = new \Psecio\SecureDotenv\Parser($keyfile, __DIR__ . '/../../.env');

                        return $parser->getContent();
                    },

                    'Guzzle' => function () {
                        return new GuzzleClient();
                    },

                    'Cache' => function () {
                        return new Cache(new \Stash\Driver\Ephemeral);
                    },

                    EntityManager::class => function (ContainerInterface $container) {
                        $secyrity = $container->get('Security');
                        $connectionParams = [
                            'dbname' => $secyrity['bd_dbname'],
                            'user' => $secyrity['db_user'],
                            'password' => $secyrity['db_password'],
                            'host' => $secyrity['db_host'],
                            'driver' => 'pdo_mysql',
                        ];

                        $config = Setup::createAnnotationMetadataConfiguration([__DIR__], false);
                        return EntityManager::create($connectionParams, $config);
                    },

                    CatchReturnMessageBus::class => function (): CatchReturnMessageBusSupportingMiddleware {
                        $query = new CatchReturnMessageBusSupportingMiddleware();
                        $query->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());
                        $commandHandlerMap = new CallableMap(
                            [
                                ProductListQuery::class => ProductListQueryHandler::class,
                            ],
                            new ServiceLocatorAwareCallableResolver(
                                function ($serviceId) {
                                    $injector = new \Auryn\Injector();
                                    $injector->define($serviceId, [
                                        'productListService' => ProductListService::class,
                                        'storageProvider' => AWSStorageProvider::class,
                                        'fileMapper' => CSVFileMapper::class,
                                    ]);
                                    $handler = $injector->make($serviceId);
                                    //TODO: some logic here
                                    return $handler;
                                }
                            )
                        );
                        $queryHandlerResolver = new NameBasedMessageHandlerResolver(
                            new ClassBasedNameResolver(), $commandHandlerMap
                        );

                        $query->appendMiddleware(new DelegatesToMessageHandlerAndCatchReturnMiddleware($queryHandlerResolver));
                        return $query;
                    },

                    CommandBus::class => function (): MessageBus {
                        $bus = new MessageBusSupportingMiddleware();
                        $bus->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());
                        $commandHandlerMap = new CallableMap(
                            [
                                ProductCreateCommand::class => ProductCreateHandler::class,
                            ],
                            new ServiceLocatorAwareCallableResolver(
                                function ($serviceId) {
                                    $injector = new \Auryn\Injector();
                                    $injector->define($serviceId,
                                        ['productCreateService' => ProductCreateService::class]);
                                    $handler = $injector->make($serviceId);
                                    //TODO: some logic here
                                    return $handler;
                                }
                            )
                        );
                        $commandHandlerResolver = new NameBasedMessageHandlerResolver(
                            new ClassBasedNameResolver(), $commandHandlerMap
                        );
                        $bus->appendMiddleware(new DelegatesToMessageHandlerMiddleware($commandHandlerResolver));
                        return $bus;
                    },

                    EventDispatcher::class => function (): EventDispatcher {
                        return new EventDispatcher();
                    },

                    Whoops::class => function () {
                        $whoops = new \Whoops\Run();
                        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
                        $whoops->register();

                        return $whoops;
                    },

                    Logger::class => function (ContainerInterface $container) {
                        $config = $container->get('Config');

                        $logger = new Logger('app');
                        $logger->pushHandler(new StreamHandler(__DIR__ . $config['log_path'], Logger::DEBUG));
                        $logger->pushHandler(new FirePHPHandler());

                        return $logger;
                    },
                    'Template' => function () {

                        $template = new MustacheTemplate();
                        $template->configuration(dirname(__DIR__) . '/Application/View');

                        return $template;
                    },
                ]
            ]
        );
    }

    public static function init(): Containers
    {
        return new self();
    }

    public function get(string $name)
    {
        if (!$this->handles instanceof ServiceManager) {
            $this->handles = new self();
        }

        return $this->handles->get($name);
    }

}