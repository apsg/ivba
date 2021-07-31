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

    public function syncCourses(QuickSale $quickSale, $courseIds = null)
    {
        if ($courseIds === null) {
            return;
        }

        if (is_integer($courseIds)) {
            $quickSale->courses()->attach($courseIds);
            $quickSale->update(['course_id' => null]);

            return;
        }

        if (is_array($courseIds) && count($courseIds) > 0) {
            $quickSale->courses()->sync($courseIds);
            $quickSale->update(['course_id' => null]);
        }
    }

    public function syncCoupons(QuickSale $quickSale, array $couponIds = [])
    {
        $quickSale->coupons()->sync($couponIds);
    }
}
