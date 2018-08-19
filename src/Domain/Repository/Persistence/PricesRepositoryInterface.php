<?php

namespace Dykyi\Domain\Repository\Persistence;

use Dykyi\Domain\Entity\Product;


/**
 * Interface PricesRepositoryInterface
 * @package Dykyi\Domain\Repository\Persistence
 */
interface PricesRepositoryInterface
{
    /**
     * @param Product $product
     * @param string $iso3
     * @param int $value
     * @return mixed
     */
    public function create(Product $product, string $iso3, int $value);

    /**'
     * @param $id
     * @return array
     */
    public function getById($id): array;
}