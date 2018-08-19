<?php

namespace Dykyi\Domain\Repository\Persistence;

use Dykyi\Domain\ValueObject\Price;

/**
 * Interface ExchangeRatesRepositoryInterface
 * @package Dykyi\Domain\Repository\Persistence
 */
interface ExchangeRatesRepositoryInterface
{
    /**
     * @param Price $price
     * @return mixed
     */
    public function create(Price $price);

    /**
     * @param string $currency
     * @return float
     */
    public function getCurrentExchangeByCurrency(string $currency): float;
}