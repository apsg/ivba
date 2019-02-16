<?php
namespace App\Listeners\Excelmailing;

use App\Events\SubscriptionCancelled;
use Gacek\IExcel\IExcel;

class SubscriptionCancelledListener
{
    public function handle(SubscriptionCancelled $event)
    {
        app(IExcel::class)
            ->excelmailing()
            ->expired($event->subscription->user->email ?? null);
    }
}