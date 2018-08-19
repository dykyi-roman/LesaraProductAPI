<?php

namespace Dykyi\Application\Mapper;

use Doctrine\Common\Collections\ArrayCollection;
use Dykyi\Infrastructure\DTO\ProductListStorageDTO;

/**
 * Class CSVFileMapper
 * @package Dykyi\Infrastructure\Mapper
 */
class CSVFileMapper implements FileMapperInterface
{
    /**
     * @param ArrayCollection $arrayCollection
     * @param ProductListStorageDTO $productListStorageDTO
     * @return mixed|string
     */
    public function map(ArrayCollection $arrayCollection, ProductListStorageDTO $productListStorageDTO): string
    {
        $fileName = __DIR__ . '\test.csv';
        $file = fopen($fileName, 'wb');

        fputcsv($file, array('sku', 'name', 'price_eur', 'created_at'));

        foreach ($arrayCollection->getIterator() as $i => $row) {
            fputcsv($file, $productListStorageDTO->make($row));
        }

        fclose($file);

        return $fileName;
    }
}