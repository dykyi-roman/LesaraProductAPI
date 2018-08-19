<?php

namespace Dykyi\Domain\ValueObject;

use Assert\Assertion;

/**
 * Class Price
 * @package Dykyi\Domain\ValueObject
 */
final class Price
{
    /**
     * @var string
     */
    private $value;
    /**
     * @var string
     */
    private $currency;

    public function __construct(string $value, string $currency)
    {
        Assertion::notEmpty($value, 'Is empty');
        Assertion::notEmpty($currency, 'Is empty');
        Assertion::numeric($value, 'Is not integer');

        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * Gets the string representation of the price.
     *
     * @return string
     *
     */
    public function __toString(): string
    {
        return trim($this->value) . ' ' . $this->currency;
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'currency' => $this->currency
        ];
    }
}