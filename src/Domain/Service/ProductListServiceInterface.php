<?php

namespace Dykyi\Domain\Service;

use Dykyi\Domain\ValueObject\DateTimeRange;
use Dykyi\Domain\ValueObject\ProductArrayTypeCollection;

/**
 * Interface ProductLIstServiceInterface
 * @package Dykyi\Domain\Service
 */
interface ProductListServiceInterface
{
    /**
     * @param DateTimeRange $dateTimeRange
     * @return void
     */
    public function execute(DateTimeRange $dateTimeRange);

    /**
     * @return ProductArrayTypeCollection
     */
    public function getList(): ProductArrayTypeCollection;
}