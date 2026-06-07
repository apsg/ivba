<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PeselRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (!preg_match('/\d{11}/', $value)) {
            return false;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $digits = str_split($value);
        $sum = 0;

        for ($i = 0; $i < count($weights); $i++) {
            $sum += ($weights[$i] * $digits[$i]);
        }

        $intSum = (10 - $sum % 10) % 10;

        return $intSum === (int)$digits[10];
    }

    public function message(): string
    {
        return 'Wymagany poprawny PESEL';
    }
}
