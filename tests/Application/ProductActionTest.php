<?php

namespace Dykyi\Tests\Application;

use Ajgl\SimpleBus\Message\Bus\CatchReturnMessageBus;
use Dykyi\Application\Containers;
use Dykyi\Domain\Message\Command\ProductCreateCommand;
use Dykyi\Domain\Message\Query\ProductListQuery;
use PHPUnit\Framework\TestCase;
use SimpleBus\Command\Bus\CommandBus;
use Symfony\Component\HttpFoundation\Request;

/**
 * @coversDefaultClass \Dykyi\Application\Controllers\ProductController
 *
 * Class ProductCreateTest
 * @package Dykyi\Tests\Application
 */
class ProductActionTest extends TestCase
{
    /** @var CommandBus */
    private $bus;

    /** @var CatchReturnMessageBus */
    private $query;

    public function setUp()
    {
        $containers = new Containers();
        $this->bus = $containers->get(CommandBus::class);
        $this->query = $containers->get(CatchReturnMessageBus::class);
    }

    /**
     * @covers ::create()
     */
    public function testCreate()
    {
        $request = new Request([
            'value' => '11',
            'currency' => 'UAH',
            'name' => 'some product',
            'sku' => 'some sku code',
        ]);

        $command = new ProductCreateCommand($request);
        $this->bus->handle($command);
    }

    /**
     * @covers ::getList()
     *
     * @throws \Exception
     */
    public function testProductListBuild()
    {
        $request = new Request([
            'from' => new \DateTimeImmutable('now'),
            'to' => new \DateTimeImmutable('now'),
        ]);
        $query = new ProductListQuery($request);
        $this->query->handle($query, $url);

        $this->assertSame('some url', $url);
    }
}