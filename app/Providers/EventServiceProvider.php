<?php

namespace App\Providers;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Events\FirstPaymentCorrectEvent;
use App\Events\SubscriptionCancelled;
use App\Events\SubscriptionPaymentFailedEvent;
use App\Events\SubscriptionProlongedEvent;
use App\Events\SubscriptionStartedEvent;
use App\Events\UserRegisteredEvent;
use App\Listeners\Emails\SendEmailAfterRegistrationListener;
use App\Listeners\FollowupsListener;
use App\Payments\Listeners\StartSubscriptionAfterFirstPaymentListener;
use App\Payments\Listeners\TryToProlongSubscriptionListener;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegisteredEvent::class                => [
            'App\Listeners\PlanUserRegisteredFollowups',
            SendEmailAfterRegistrationListener::class,
            FollowupsListener::class,
        ],
        \App\Events\UserPaidForAccess::class      => [
            'App\Listeners\PlanUserPaidFollowups',
        ],
        \App\Events\UserPaidAccessFinished::class => [
            'App\Listeners\PlanUserExpiredFollowups',
        ],
        'App\Events\OrderLeft24hAgo'              => [
            //
        ],
        'App\Events\OrderLeft72hAgo'              => [
            //
        ],
        SubscriptionCancelled::class              => [
            'App\Listeners\SendSubscriptionFailedEmail',
        ],
        SubscriptionStartedEvent::class           => [
            FollowupsListener::class,
        ],
        SubscriptionProlongedEvent::class         => [
            FollowupsListener::class,
        ],
        ActiveSubscriptionExpiredEvent::class     => [
            TryToProlongSubscriptionListener::class,
        ],
        SubscriptionPaymentFailedEvent::class     => [
            FollowupsListener::class,
        ],
        PasswordReset::class                      => [
            'App\Listeners\UpdateLastPasswordChange',
        ],
        FirstPaymentCorrectEvent::class           => [
            StartSubscriptionAfterFirstPaymentListener::class,
            FollowupsListener::class,
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
