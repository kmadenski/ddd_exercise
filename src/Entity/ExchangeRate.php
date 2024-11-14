<?php

namespace Domain\Entity;

use Domain\ValueObject\Currency;

final class ExchangeRate
{
    private Currency $from;
    private Currency $to;
    private float $rate;

    public function __construct(Currency $from, Currency $to, float $rate)
    {
        if ($rate <= 0) {
            throw new \InvalidArgumentException("Exchange rate must be positive.");
        }
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    public function getFrom(): Currency
    {
        return $this->from;
    }

    public function getTo(): Currency
    {
        return $this->to;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
