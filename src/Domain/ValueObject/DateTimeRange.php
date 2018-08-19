<?php

namespace Dykyi\Domain\ValueObject;

/**
 * Class DateTimeRange
 * @package Dykyi\Domain\ValueObject
 */
final class DateTimeRange
{
    /**
     * @var \DateTimeImmutable
     */
    private $from;
    /**
     * @var \DateTimeImmutable
     */
    private $to;

    /**
     * DateTimeRange constructor.
     * @param \DateTimeImmutable $from
     * @param \DateTimeImmutable $to
     */
    public function __construct(\DateTimeImmutable $from, \DateTimeImmutable $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFrom(): \DateTimeImmutable
    {
        return $this->from;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTo(): \DateTimeImmutable
    {
        return $this->to;
    }
}