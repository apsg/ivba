<?php
namespace App\Payments\Tpay;

class TpayHelper
{
    const REASONS = [
        '00' => 'Response block on Elavon level (unexpected error)',
        '01' => 'Vocal authorization required',
        '02' => 'Vocal authorization required',
        '03' => 'Invalid/insufficient card data',
        '04' => 'Card reserved',
        '07' => 'Card reserved',
        '05' => 'Payment type MOTO/eCommerce not activated or limit exceeded',
        '13' => 'Payment type MOTO/eCommerce not activated or limit exceeded',
        '57' => 'Payment type MOTO/eCommerce not activated or limit exceeded',
        '61' => 'Payment type MOTO/eCommerce not activated or limit exceeded',
        '12' => 'Invalid transaction',
        '14' => 'Invalid card number',
        '30' => 'Invalid data format of authorization message',
        '41' => 'Card marked as lost',
        '43' => ' Card marked as stolen',
        '51' => ' Insufficient funds',
        '54' => ' Card outdated',
        '59' => ' Fraud suspicion',
        '65' => ' Card usage limit exceeded',
        '78' => ' New, not activated card',
        '82' => 'Invalid CVV code',
        'N7' => 'Invalid CVV code',
        '99' => 'Invalid API password',
    ];

    public static function translateReason(string $code) : string
    {
        if (isset(static::REASONS[$code])) {
            return static::REASONS[$code];
        }

        return $code;
    }
}