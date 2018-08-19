<?php

namespace Dykyi\Domain\Service;

use Dykyi\Domain\Entity\Product;

/**
 * Interface CreateProductServiceInterface
 * @package Dykyi\Domain\Service
 */
interface ProductCreateServiceInterface
{
    /**
     * @param Product $request
     *
     * @return void
     */
    public function execute(Product $request);
}