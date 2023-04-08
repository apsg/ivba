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

    public function handle(SubscriptionCancelled $event)
    {
        $event->subscription->load('user');

        if ($event->subscription->user === null) {
            return;
        }
        try {
            $event->subscription->user->notify(
                new SubscriptionFailed($event->subscription)
            );
        } catch (\Swift_TransportException $e) {
            // Do nothing
        }
    }
}
