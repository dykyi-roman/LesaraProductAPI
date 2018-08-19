<?php

namespace Dykyi\Domain\Message\Query;

use Dykyi\Domain\ValueObject\DateTimeRange;
use SimpleBus\Command\Command;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductListQuery
 * @package Dykyi\Domain\Message\Query
 */
class ProductListQuery implements Command
{
    /**
     * @var Request
     */
    private $request;

    /**
     * ProductListQuery constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return DateTimeRange
     */
    public function getDateTimeRange(): DateTimeRange
    {
        return new DateTimeRange($this->request->get('from'), $this->request->get('to'));
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'get-product-list';
    }
}