<?php

namespace Dykyi\Domain\Entity;

use Dykyi\Domain\ValueObject\Price;

/**
 * Class Product
 * @package Dykyi\Domain\ValueObject
 */
final class Product
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $sku;
    /**
     * @var string
     */
    private $name;
    /**
     * @var Price
     */
    private $price;
    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * Product constructor.
     *
     * @param Price $price
     * @param string $name
     * @param string $sku
     */
    public function __construct(Price $price, string $name, string $sku)
    {
        $this->price = $price;
        $this->name = $name;
        $this->sku = $sku;
        $this->created_at = new \DateTime('now');
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

}