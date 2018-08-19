<?php

namespace Dykyi\Application\Controllers;

use Ajgl\SimpleBus\Message\Bus\CatchReturnMessageBus;
use Dykyi\Application\Containers;
use Dykyi\Domain\Event\ProductCreateDone;
use Dykyi\Domain\Event\ProductListBuildDone;
use Dykyi\Domain\Message\Command\ProductCreateCommand;
use Dykyi\Domain\Message\Query\ProductListQuery;
use SimpleBus\Command\Bus\CommandBus;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @property Request request
 * @property CommandBus bus
 * @property CatchReturnMessageBus query
 * @property EventDispatcher dispatcher
 *
 * @package Dykyi\Infrastructure\Controllers
 */
class ProductController
{
    /** @var CommandBus bus */
    private $bus;

    /** @var CatchReturnMessageBus $query */
    private $query;

    /** @var EventDispatcher $dispatcher */
    private $dispatcher;

    /**
     * DefaultController constructor.
     *
     * @param Request $request
     * @param Containers $containers
     */
    public function __construct(Request $request, Containers $containers)
    {
        $this->request = $request;
        $this->dispatcher = $containers->get(EventDispatcher::class);
        $this->bus = $containers->get(CommandBus::class);
        $this->query = $containers->get(CatchReturnMessageBus::class);
    }

    /**
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $this->bus->handle(new ProductCreateCommand($this->request));
        $this->dispatcher->dispatch(new ProductCreateDone());

        return JsonResponse::create(['result' => true]);
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function getList(): JsonResponse
    {
        $this->query->handle(new ProductListQuery($this->request), $url);
        $this->dispatcher->dispatch(new ProductListBuildDone());

        return JsonResponse::create(['result' => $url]);
    }
}