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
}
