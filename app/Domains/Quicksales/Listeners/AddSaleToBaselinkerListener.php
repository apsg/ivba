<?php
namespace App\Domains\Quicksales\Listeners;

use App\Events\QuickSaleConfirmedEvent;
use Apsg\Baselinker\Facades\Baselinker;

class AddSaleToBaselinkerListener
{
    public function handle(QuickSaleConfirmedEvent $event)
    {
        \Log::info(__CLASS__, [
            'qs'   => $event->quicksale,
            'user' => $event->user,
        ]);

        if ($event->quicksale === null
            || $event->quicksale->baselinker_id === null
            || config('baselinker.token') === null) {
            \Log::info('bail out');

            return;
        }

        $arr = [
            'email'            => $event->user->email,
            'invoice_fullname' => $event->user->full_name,
            'phone'            => $event->user->phone,
            'products'         => [
                [
                    'storage'      => 'db',
                    'storage_id'   => 0,
                    'product_id'   => $event->quicksale->baselinker_id,
                    'quantity'     => 1,
                    'price_brutto' => $event->quicksale->price,
                    'name'         => $event->quicksale->name,
                ],
            ],
        ];

        \Log::info(__CLASS__, compact('arr'));

        Baselinker::orders()
            ->addOrder($arr);
    }
}