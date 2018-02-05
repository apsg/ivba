<?php

namespace App\Listeners;

use App\Events\SubscriptionCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  SubscriptionPaymentFailed  $event
     * @return void
     */
    public function handle(SubscriptionCancelled $event)
    {
        
        $event->subscription->user->notify(
            new \App\Notifications\SubscriptionFailed($event->subscription)
        );

    }
}
