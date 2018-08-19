<?php

namespace Dykyi\Domain\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;
use Dykyi\Domain\Entity\Product;

/**
 * Class ProductArrayTypeCollection
 * @package Dykyi\Domain\ValueObject
 */
final class ProductArrayTypeCollection extends ArrayCollection
{
    /**
     * @param $element
     * @return bool
     */
    public function add($element): bool
    {
        if ($element instanceof Product) {
            return parent::add($element);
        }

        return true;
    }
}