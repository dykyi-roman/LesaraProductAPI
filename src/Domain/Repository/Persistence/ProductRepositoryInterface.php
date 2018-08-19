<?php

namespace Dykyi\Domain\Repository\Persistence;

use Doctrine\Common\Collections\ArrayCollection;
use Dykyi\Domain\Entity\Product;
use Dykyi\Domain\ValueObject\DateTimeRange;

/**]
 * Interface ProductRepositoryInterface
 * @package Dykyi\Domain\Repository
 */
interface ProductRepositoryInterface
{
    /**
     * @param Product $product
     *
     * @return string
     */
    public function create(Product $product): string;

    /**
     * @param DateTimeRange $date
     *
     * @return ArrayCollection
     */
    public function getList(DateTimeRange $date): ArrayCollection;
}