<?php
namespace App\Repositories;

use App\Events\SubscriptionCancelled;
use App\Events\SubscriptionStartedEvent;
use App\Payments\Exceptions\PaymentException;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use InvalidArgumentException;

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
    public function cancel(Subscription $subscription) : Subscription
    {
        $subscription->update([
            'cancelled_at' => Carbon::now(),
            'is_active'    => false,
            'token'        => null,
        ]);

        event(new SubscriptionCancelled($subscription));

        return $subscription;
    }

    public function makeActive(Subscription $subscription, $token = null) : Subscription
    {
        if (empty($token)) {
            throw new PaymentException('Missing card token');
        }

        $subscription->update([
            'is_active'   => true,
            'token'       => $token,
            'valid_until' => Carbon::now(),
            'amount'      => config('ivba.subscription_price'),
        ]);

        event(new SubscriptionStartedEvent($subscription));

        return $subscription;
    }

    public function prolong(Subscription $subscription) : Subscription
    {
        if (!$subscription->isActive()) {
            throw new InvalidArgumentException("Subscription {$subscription->id} was cancelled {$subscription->cancelled_at}");
        }

        $valid = max($subscription->valid_until->timestamp, Carbon::now()->timestamp);

        $subscription->update([
            'valid_until' => Carbon::createFromTimestamp($valid)->addMinutes(3),
            'tries'       => 0,
        ]);

        return $subscription;
    }

    public function tryFailed(Subscription $subscription)
    {
        if ($subscription->tries < 3) {
            $subscription->update([
                'tries' => $subscription->tries + 1,
            ]);

            return $subscription;
        }

        return $this->cancel($subscription);
    }
}