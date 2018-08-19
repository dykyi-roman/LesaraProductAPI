<?php

namespace Dykyi\Infrastructure\Repository\Persistence\InMemory;

use Dykyi\Domain\Entity\Product;
use Dykyi\Domain\Repository\Persistence\PricesRepositoryInterface;

/**
 * Class InMemoryPricesRepository
 * @package Dykyi\Infrastructure\Repository\Persistence\InMemory
 */
class InMemoryPricesRepository implements PricesRepositoryInterface
{
    private $prices = [];

    /**
     * @param Product $product
     * @param string $iso3
     * @param int $value
     */
    public function create(Product $product, string $iso3, int $value)
    {
        $prices[$product->getId()] = [
            'iso3' => $iso3,
            'value' => $value
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id): array
    {
        return $this->prices[$id];
    }
}