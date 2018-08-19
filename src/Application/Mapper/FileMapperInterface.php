<?php

namespace Dykyi\Application\Mapper;

use Doctrine\Common\Collections\ArrayCollection;
use Dykyi\Infrastructure\DTO\ProductListStorageDTO;

/**
 * Interface FileMapperInterface
 * @package Dykyi\Application\Mapper
 */
interface FileMapperInterface
{
    /**
     * @param ArrayCollection $arrayCollection
     * @param ProductListStorageDTO $productListStorageDTO
     * @return string
     */
    public function map(ArrayCollection $arrayCollection, ProductListStorageDTO $productListStorageDTO): string;
}