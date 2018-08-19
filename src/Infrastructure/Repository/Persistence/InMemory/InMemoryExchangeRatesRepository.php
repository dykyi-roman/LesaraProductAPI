<?php

namespace Dykyi\Infrastructure\Repository\Persistence\InMemory;

use Dykyi\Domain\Repository\Persistence\ExchangeRatesRepositoryInterface;
use Dykyi\Domain\ValueObject\Price;

/**
 * Class InMemoryExchangeRatesRepository
 * @package Dykyi\Infrastructure\Repository\Persistence\InMemory
 */
class InMemoryExchangeRatesRepository implements ExchangeRatesRepositoryInterface
{
    private $exchanges = [];

    /**
     * @param Price $price
     * @return mixed|void
     */
    public function create(Price $price)
    {
        $this->exchanges[(new \DateTime())->getTimestamp()] = $price;
    }

    /**
     * @param string $currency
     * @return float
     */
    public function getCurrentExchangeByCurrency(string $currency): float
    {
        return 0;
    }
}