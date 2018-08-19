<?php

namespace Dykyi\Domain\Message\CommandHandler;

use Dykyi\Domain\Message\Command\ProductCreateCommand;
use Dykyi\Domain\Service\ProductCreateServiceInterface;

/**
 * Class CreateProductHandler
 * @package Dykyi\Domain\Message\CommandHandler
 */
class ProductCreateHandler
{
    /**
     * @var ProductCreateServiceInterface
     */
    private $productCreateService;

    /**
     * CreateProductHandler constructor.
     * @param ProductCreateServiceInterface $productCreateService
     */
    public function __construct(ProductCreateServiceInterface $productCreateService)
    {
        $this->productCreateService = $productCreateService;
    }

    /**
     * @param ProductCreateCommand $command
     * @throws \Exception
     */
    public function handle(ProductCreateCommand $command)
    {
        $this->productCreateService->execute($command->getProduct());
    }
}