<?php

namespace Dykyi\Infrastructure\DTO;

use Dykyi\Domain\ValueObject\ProductArrayTypeCollection;

/**
 * Class ProductListStorageDTO
 * @package Dykyi\Infrastructure\DTO
 */
class ProductListStorageDTO
{
    /**
     * @var array
     */
    private $products;
    /**
     * @var ProductArrayTypeCollection
     */
    /**
     * @param ProductArrayTypeCollection $arrayTypeCollection
     * @return array
     */
    public function make(ProductArrayTypeCollection $arrayTypeCollection): array
    {
        $products = [];
        //TODO:: Put some logic here for transform
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->products;
    }
}