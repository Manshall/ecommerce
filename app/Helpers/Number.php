<?php

namespace App\Helpers;

class Number
{
    public static function currency($amount, $currency = '$', $decimals = 2)
    {
        return number_format($amount, $decimals) . " " . $currency;
    }
}
