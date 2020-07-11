<?php
namespace App\Listeners;

use App\Events\UserPaidForAccess;

class CancelExistingSubscriptionListener
{
    public function handle(UserPaidForAccess $event)
    {
        $user = $event->user;

        if ($user !== null && $user->hasActiveSubscription()) {
            $subscription = $user->activeSubscription();

            if ($subscription !== null) {
                $subscription->cancel();
            }
        }
    }
}
