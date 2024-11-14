<?php

// src/Domain/Service/ExchangeService.php
namespace Domain\Service;

use Domain\ValueObject\Currency;
use Domain\ValueObject\Money;
use Domain\Repository\ExchangeRateRepositoryInterface;
use Domain\Exception\ExchangeException;

final class ExchangeService
{
    private ExchangeRateRepositoryInterface $rateRepository;
    private float $feePercentage;

    public function __construct(ExchangeRateRepositoryInterface $rateRepository, float $feePercentage = 0.01)
    {
        if ($feePercentage < 0 || $feePercentage > 1) {
            throw new \InvalidArgumentException("Fee percentage must be between 0 and 1.");
        }
        $this->rateRepository = $rateRepository;
        $this->feePercentage = $feePercentage;
    }


    public function sell(Money $sourceMoney, Currency $targetCurrency): Money
    {
        $rate = $this->rateRepository->getRate($sourceMoney->getCurrency(), $targetCurrency);
        $convertedAmount = $sourceMoney->getAmount() * $rate->getRate();

        $fee = $convertedAmount * $this->feePercentage;
        $amountAfterFee = $convertedAmount + $fee;

        return new Money($amountAfterFee, $targetCurrency);
    }

    public function buy(Money $targetMoney, Currency $sourceCurrency): Money
    {
        $rate = $this->rateRepository->getRate($sourceCurrency, $targetMoney->getCurrency());
        $convertedAmount = $targetMoney->getAmount() * $rate->getRate();

        $fee = $convertedAmount * $this->feePercentage;
        $totalAmount = $convertedAmount - $fee;

        return new Money($totalAmount, $sourceCurrency);
    }
}
