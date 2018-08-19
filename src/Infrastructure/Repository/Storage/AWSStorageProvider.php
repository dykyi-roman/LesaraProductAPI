<?php

namespace Dykyi\Infrastructure\Repository\Storage;

use Dykyi\Domain\Repository\Storage\StorageProviderInterface;

/**
 * Class AWSStorageProvider
 * @package Dykyi\Infrastructure\Repository\Storage
 */
class AWSStorageProvider implements StorageProviderInterface
{
    /**
     * @param string $file
     * @return int
     * @throws \Exception
     */
    public function save(string $file): int
    {
        return random_int(1, 100);
    }

    /**
     * @param string $file
     * @return string
     */
    public function getFileUrlById(string $file): string
    {
        return 'some url';
    }
}