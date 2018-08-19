<?php

namespace Dykyi\Infrastructure\Service;

use Dykyi\Domain\Entity\Product;
use Dykyi\Domain\Repository\Persistence\ProductRepositoryInterface;
use Dykyi\Domain\Service\ProductCreateServiceInterface;
use Dykyi\Infrastructure\Repository\Persistence\InMemory\InMemoryProductRepository;

/**
 * Class CreateProductService
 * @package Dykyi\Infrastructure\Service
 */
class ProductCreateService implements ProductCreateServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * CreateProduct constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(InMemoryProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Product $product
     * @return void
     * @throws \Exception
     */
    public function execute(Product $product)
    {
        //TODO: Some logic here
        $this->productRepository->create($product);
    }
}