<?php

namespace App\Constant;

class CurrencyConst
{
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_USD = 'USD';
    const CURRENCY_GBP = 'GBP';

    const VALID_CURRENCIES = [
        self::CURRENCY_EUR,
        self::CURRENCY_USD,
        self::CURRENCY_GBP,
    ];

    const DEFAULT_CURRENCY = self::CURRENCY_EUR;

    const CURRENCY_RATES = [
        self::CURRENCY_USD => 1.14,
        self::CURRENCY_GBP => 0.88,
    ];
}
