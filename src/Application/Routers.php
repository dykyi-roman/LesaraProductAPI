<?php

namespace Dykyi\Application;

use Dykyi\Application\Controllers\ProductController;

/**
 * Class Routers
 *
 * @package Dykyi\Infrastructure
 */
class Routers
{
    public static function get(): array
    {
        return [
            ['POST', '/product/create', [ProductController::class, 'create']],
            ['GET', '/product/list', [ProductController::class, 'getList']],
        ];
    }
}