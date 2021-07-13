<?php
namespace App\Repositories;

use App\QuickSale;

class QuickSaleRepository
{
    const PAYMENT_TPAY = 'tpay';
    const PAYMENT_PAYU = 'payu';

    public function create(array $attributes = []) : QuickSale
    {
        return QuickSale::create($attributes);
    }

    public function findByHash(string $hash) : QuickSale
    {
        return QuickSale::where('hash', '=', $hash)
            ->firstOrFail();
    }

    public function availablePayments() : array
    {
        return [
            static::PAYMENT_PAYU,
            static::PAYMENT_TPAY,
        ];
    }

    public function syncCourses(QuickSale $quickSale, $input = null)
    {
        if ($input === null) {
            return;
        }

        if (is_integer($input)) {
            $quickSale->courses()->attach($input);
            $quickSale->update(['course_id' => null]);

            return;
        }

        if (is_array($input) && count($input) > 0) {
            $quickSale->courses()->sync($input);
            $quickSale->update(['course_id' => null]);
        }
    }
}
