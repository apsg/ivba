<?php
namespace App\Listeners\Excelmailing;

use App\Events\SubscriptionStartedEvent;
use Gacek\IExcel\IExcel;

class SubscriptionStartedListener
{
    public function handle(SubscriptionStartedEvent $event)
    {
        app(IExcel::class)
            ->excelmailing()
            ->register($event->subscription->user->email ?? null);
    }
}