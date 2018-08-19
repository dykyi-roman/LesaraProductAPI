<?php

namespace Dykyi\Infrastructure\Repository\Persistence\InMemory;

use Doctrine\Common\Collections\ArrayCollection;
use Dykyi\Domain\Entity\Product;
use Dykyi\Domain\Repository\Persistence\ProductRepositoryInterface;
use Dykyi\Domain\ValueObject\DateTimeRange;
use Dykyi\Domain\ValueObject\ProductArrayTypeCollection;
use Dykyi\Domain\ValueObject\UUID;

/**
 * Class InMemoryProductRepository
 * @package Dykyi\Infrastructure\Repository\Persistence\InMemory
 */
class InMemoryProductRepository implements ProductRepositoryInterface
{

    private $products;

    public function __construct()
    {
        $this->products = new ProductArrayTypeCollection();
    }

    /**
     * @param Product $product
     *
     * @return string
     * @throws \Exception
     */
    public function create(Product $product): string
    {
        if ($product->getId() === null) {
            $uuid = UUID::generate();
            $product->setId($uuid);
        }
        $this->products->add($product);

        return $product->getId();
    }

    /**
     * @param DateTimeRange $date
     *
     * @return ArrayCollection
     */
    public function getList(DateTimeRange $date): ArrayCollection
    {
        //TODO:: Some logic for get elements list
        return $this->products;
    }
}