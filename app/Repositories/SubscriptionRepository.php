<?php
namespace App\Repositories;

use App\Payment;
use App\Subscription;
use App\User;
use Carbon\Carbon;

class SubscriptionRepository
{
    public function create(User $user) : Subscription
    {
        if ($user->hasActiveSubscription()) {
            return $user->currentSubscription();
        }

        $subscription = Subscription::create([
            'user_id' => $user->id,
        ]);

        return $subscription;
    }

    /**
     * Anuluj subskrypcję
     * @return [type] [description]
     */
    public function cancel()
    {
        $this->update([
            'cancelled_at' => Carbon::now(),
            'is_active'    => false,
        ]);

        return $this;
    }

}