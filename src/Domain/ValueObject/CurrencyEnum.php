<?php
// src/Domain/ValueObject/CurrencyEnum.php

namespace Domain\ValueObject;

abstract class CurrencyEnum
{
    public const EUR = 'EUR';
    public const GBP = 'GBP';

    public static function getAll(): array
    {
        return [
            self::EUR,
            self::GBP
        ];
    }

    public static function isValid(string $code): bool
    {
        return in_array(strtoupper($code), self::getAll(), true);
    }
}
