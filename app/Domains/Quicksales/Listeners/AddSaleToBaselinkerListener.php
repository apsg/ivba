<?php
namespace App\Domains\Quicksales\Listeners;

use App\Events\QuickSaleConfirmedEvent;
use Apsg\Baselinker\Facades\Baselinker;

class AddSaleToBaselinkerListener
{
    public function handle(QuickSaleConfirmedEvent $event)
    {
        if ($event->quicksale === null
            || $event->quicksale->baselinker_id === null
            || config('baselinker.token') === null) {
            return;
        }

        Baselinker::orders()
            ->addOrder([
                'email'            => $event->user->email,
                'invoice_fullname' => $event->user->full_name,
                'quantity'         => $event->user->phone,
                'products'         => [
                    'product_id' => $event->quicksale->baselinker_id,
                    'quantity'   => 1,
                ],
            ]);
    }
}