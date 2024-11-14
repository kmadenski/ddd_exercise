<?php
namespace Domain\Repository;

use Domain\ValueObject\Currency;
use Domain\Entity\ExchangeRate;

interface ExchangeRateRepositoryInterface
{
    public function getRate(Currency $from, Currency $to): ExchangeRate;
}