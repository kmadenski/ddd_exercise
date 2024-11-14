<?php
namespace Domain\ValueObject;

final class Money
{
    private int $amount;
    private Currency $currency;

    public function __construct(int $amount, Currency $currency)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Amount cannot be negative.");
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function add(Money $other): Money
    {
        if (!$this->currency->equals($other->getCurrency())) {
            throw new \InvalidArgumentException("Cannot add amounts with different currencies.");
        }
        return new Money($this->amount + $other->getAmount(), $this->currency);
    }

    public function subtract(Money $other): Money
    {
        if (!$this->currency->equals($other->getCurrency())) {
            throw new \InvalidArgumentException("Cannot subtract amounts with different currencies.");
        }
        $result = $this->amount - $other->getAmount();
        if ($result < 0) {
            throw new \InvalidArgumentException("Resulting amount cannot be negative.");
        }
        return new Money($result, $this->currency);
    }
}
