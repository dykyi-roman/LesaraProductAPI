<?php

namespace Dykyi\Infrastructure\Service;

use Dykyi\Domain\Repository\Persistence\ProductRepositoryInterface;
use Dykyi\Domain\Service\ProductListServiceInterface;
use Dykyi\Domain\ValueObject\DateTimeRange;
use Dykyi\Domain\ValueObject\ProductArrayTypeCollection;
use Dykyi\Infrastructure\Repository\Persistence\InMemory\InMemoryProductRepository;

/**
 * Class ProductListService
 * @package Dykyi\Infrastructure\Service
 */
class ProductListService implements ProductListServiceInterface
{
    /** @var ProductArrayTypeCollection */
    private $products;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductListService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(InMemoryProductRepository $productRepository)
    {
        $this->products = new ProductArrayTypeCollection();
        $this->productRepository = $productRepository;
    }

    /**
     * @param DateTimeRange $dateTimeRange
     * @return void
     */
    public function execute(DateTimeRange $dateTimeRange)
    {
        //TODO: Put some logic here
        $this->products = $this->productRepository->getList($dateTimeRange);
    }

    public function getList(): ProductArrayTypeCollection
    {
        return $this->products;
    }
}