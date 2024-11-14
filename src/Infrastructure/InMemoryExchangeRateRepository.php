<?php
namespace Infrastructure\Repository;

use Domain\ValueObject\Currency;
use Domain\Entity\ExchangeRate;
use Domain\Repository\ExchangeRateRepositoryInterface;
use Domain\Exception\ExchangeException;
use Domain\ValueObject\CurrencyEnum;

final class InMemoryExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * @var ExchangeRate[]
     */
    private array $rates = [];

    public function __construct()
    {
        // Initialize with predefined rates
        $eur = new Currency(CurrencyEnum::EUR);
        $gbp = new Currency(CurrencyEnum::GBP);

        $this->rates[] = new ExchangeRate($eur, $gbp, 1.5678);
        $this->rates[] = new ExchangeRate($gbp, $eur, 1.5432);
    }

    public function getRate(Currency $from, Currency $to): ExchangeRate
    {
        foreach ($this->rates as $rate) {
            if ($rate->getFrom()->equals($from) && $rate->getTo()->equals($to)) {
                return $rate;
            }
        }

        throw new ExchangeException("Exchange rate from {$from->getCode()} to {$to->getCode()} not found.");
    }
}
