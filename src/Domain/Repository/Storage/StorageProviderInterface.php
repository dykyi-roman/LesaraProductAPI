<?php

namespace Dykyi\Domain\Repository\Storage;

/**
 * Interface AWSProviderInterface
 * @package Dykyi\Domain\Repository\Storage
 */
interface StorageProviderInterface
{
    /**
     * @param string $file
     * @return int
     */
    public function save(string $file): int;

    /**
     * @param string $file
     * @return string
     */
    public function getFileUrlById(string $file): string;
}