<?php

namespace Dykyi\Domain\Message\QueryHandler;

use Dykyi\Application\Mapper\FileMapperInterface;
use Dykyi\Domain\Message\Query\ProductListQuery;
use Dykyi\Domain\Repository\Storage\StorageProviderInterface;
use Dykyi\Domain\Service\ProductListServiceInterface;
use Dykyi\Infrastructure\DTO\ProductListStorageDTO;

/**
 * Class ProductListQueryHandler
 * @package Dykyi\Domain\Message\QueryHandler
 */
class ProductListQueryHandler
{
    /**
     * @var ProductListServiceInterface
     */
    private $productListService;
    /**
     * @var StorageProviderInterface
     */
    private $storageProvider;
    /**
     * @var FileMapperInterface
     */
    private $fileMapper;

    /**
     * ProductListQueryHandler constructor.
     *
     * @param ProductListServiceInterface $productListService
     * @param StorageProviderInterface $storageProvider
     * @param FileMapperInterface $fileMapper
     */
    public function __construct(
        ProductListServiceInterface $productListService,
        StorageProviderInterface $storageProvider,
        FileMapperInterface $fileMapper
    ) {
        $this->productListService = $productListService;
        $this->storageProvider = $storageProvider;
        $this->fileMapper = $fileMapper;
    }

    /**
     * @param ProductListQuery $query
     * @return string
     */
    public function handle(ProductListQuery $query): string
    {
        $this->productListService->execute($query->getDateTimeRange());
        $productList = $this->productListService->getList();

        $file = $this->fileMapper->map($productList, new ProductListStorageDTO());
        $fileId = $this->storageProvider->save($file);

        return $this->storageProvider->getFileUrlById($fileId);
    }
}