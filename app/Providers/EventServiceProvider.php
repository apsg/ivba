<?php

namespace App\Providers;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Events\FirstPaymentCorrectEvent;
use App\Events\SubscriptionCancelled;
use App\Events\SubscriptionProlongedEvent;
use App\Events\SubscriptionStartedEvent;
use App\Payments\Listeners\StartSubscriptionAfterFirstPaymentListener;
use App\Payments\Listeners\TryToProlongSubscriptionListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\UserRegistered::class            => [
            'App\Listeners\PlanUserRegisteredFollowups',
        ],
        \App\Events\UserPaidForAccess::class         => [
            'App\Listeners\PlanUserPaidFollowups',
        ],
        \App\Events\UserPaidAccessFinished::class    => [
            'App\Listeners\PlanUserExpiredFollowups',
        ],
        'App\Events\OrderLeft24hAgo'                 => [
            'App\Listeners\PlanOrderLeft24Followups',
        ],
        'App\Events\OrderLeft72hAgo'                 => [
            'App\Listeners\PlanOrderLeft72Followups',
        ],
        SubscriptionCancelled::class                 => [
            'App\Listeners\SendSubscriptionFailedEmail',
        ],
        SubscriptionStartedEvent::class              => [
            //
        ],
        SubscriptionProlongedEvent::class            => [
            //
        ],
        ActiveSubscriptionExpiredEvent::class        => [
            TryToProlongSubscriptionListener::class,
        ],
        \Illuminate\Auth\Events\PasswordReset::class => [
            'App\Listeners\UpdateLastPasswordChange',
        ],
        FirstPaymentCorrectEvent::class              => [
            StartSubscriptionAfterFirstPaymentListener::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
