<?php
namespace App\Payments\Tpay;

class TpayHelper
{
    const REASONS = [
        '00' => 'Zablokowano po stronie Elavon (niespodziewany błąd)',
        '01' => 'Wymagana autoryzacja głosowa',
        '02' => 'Wymagana autoryzacja głosowa',
        '03' => 'Błędne lub brakujące dane karty',
        '04' => 'Karta zastrzeżona',
        '07' => 'Karta zastrzeżona',
        '05' => 'Płatność typu MOTO zastrzeżona lub przekroczono limit dla tego typu płatności',
        '13' => 'Płatność typu MOTO zastrzeżona lub przekroczono limit dla tego typu płatności',
        '57' => 'Płatność typu MOTO zastrzeżona lub przekroczono limit dla tego typu płatności',
        '61' => 'Płatność typu MOTO zastrzeżona lub przekroczono limit dla tego typu płatności',
        '12' => 'Niewłaściwa transakcja',
        '14' => 'Błędny numer karty',
        '30' => 'Niewłaściwe dane autoryzacyjne',
        '41' => 'Karta zastrzeżona - skradziona',
        '43' => 'Karta zastrzeżona - skradziona',
        '51' => 'Brak środków',
        '54' => 'Termin ważności karty minął',
        '59' => 'Podejrzenie oszustwa',
        '65' => 'Przekroczono limit płatności',
        '78' => 'Nowa karta nie została jeszcze aktywowana',
        '82' => 'Błędny kod CVV',
        'N7' => 'Błędny kod CVV',
        '99' => 'Niewłaściwe hasło API',
    ];

    public static function translateReason(string $code = null) : string
    {
        if ($code === null) {
            return '';
        }

        if (isset(static::REASONS[$code])) {
            return static::REASONS[$code];
        }

        return $code;
    }
}