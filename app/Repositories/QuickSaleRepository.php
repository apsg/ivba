<?php
namespace App\Repositories;

use App\QuickSale;

class QuickSaleRepository
{
    public function create(array $attributes = []) : QuickSale
    {
        return QuickSale::create($attributes);
    }

    public function findByHash(string $hash) : QuickSale
    {
        return QuickSale::where('hash', '=', $hash)
            ->firstOrFail();
    }
}
