<?php

namespace App\Listeners;

use App\Events\SubscriptionCancelled;
use App\Notifications\SubscriptionFailed;

class SendSubscriptionFailedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionPaymentFailed $event
     * @return void
     */
    public function handle(SubscriptionCancelled $event)
    {
        $event->subscription->load('user');

        if ($event->subscription->user === null) {
            return;
        }

        $event->subscription->user->notify(
            new SubscriptionFailed($event->subscription)
        );
    }
}
