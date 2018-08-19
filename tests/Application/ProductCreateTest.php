<?php

namespace Dykyi\Tests\Application;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductCreateTest
 * @package Dykyi\Tests\Application
 */
class ProductCreateTest extends TestCase
{
    public function testCreate()
    {
        $this->request = new Request([
            'value' => '11',
            'currency' => 'UAH',
            'name' => 'some product',
            'sku' => 'some sku code',
        ]);

        $this->request = new Request([
            'from' => new \DateTimeImmutable('now'),
            'to' => new \DateTimeImmutable('now'),
        ]);
    }
}