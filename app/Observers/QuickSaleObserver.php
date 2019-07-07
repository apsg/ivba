<?php
namespace App\Observers;

use App\QuickSale;

class QuickSaleObserver
{
    public function creating(QuickSale $quickSale)
    {
        $quickSale->hash = uniqid();
    }
}
