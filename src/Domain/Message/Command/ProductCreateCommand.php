<?php

namespace Dykyi\Domain\Message\Command;

use Dykyi\Domain\Entity\Product;
use Dykyi\Domain\ValueObject\Price;
use SimpleBus\Command\Command;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateProductCommand
 * @package Dykyi\Domain\Message\Command
 */
class ProductCreateCommand implements Command
{
    /**
     * @var Request
     */
    private $request;

    /**
     * CreateProductCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return new Product($this->getPrice(), $this->request->get('sku'), $this->request->get('name'));
    }

    /**
     * @return Price
     */
    private function getPrice(): Price
    {
        return new Price($this->request->get('value'), $this->request->get('currency'));
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'create-product';
    }
}