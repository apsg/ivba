<?php
namespace App\Payments\Listeners;

use App\Events\FirstPaymentCorrectEvent;
use App\Repositories\SubscriptionRepository;

class StartSubscriptionAfterFirstPaymentListener
{
    public function handle(FirstPaymentCorrectEvent $event)
    {
        $event->payment->subscription;

        app(SubscriptionRepository::class)
            ->makeActive($event->payment->subscription, $event->payment->external_id);
    }
}