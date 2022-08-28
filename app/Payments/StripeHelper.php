<?php
namespace App\Payments;

class StripeHelper
{
    public static function priceToCents(float $price): int
    {
        return floor($price * 100 + 1e-6);
    }

    public static function centsToPrice(int $cents): float
    {
        return $cents / 100;
    }
}
