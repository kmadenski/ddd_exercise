<?php

namespace Domain\ValueObject;

use Domain\Exception\InvalidCurrencyException;

final class Currency
{
    private string $code;

    public function __construct(string $code)
    {
        if (!CurrencyEnum::isValid($code)) {
            throw new InvalidCurrencyException("Unsupported currency: {$code}");
        }
        $this->code = strtoupper($code);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function equals(Currency $other): bool
    {
        return $this->code === $other->getCode();
    }
}
