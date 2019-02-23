<?php

namespace App\Providers;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Events\FirstPaymentCorrectEvent;
use App\Events\FullAccessGrantedEvent;
use App\Events\NewAccessGrantedEvent;
use App\Events\OrderLeft24hAgo;
use App\Events\OrderLeft72hAgo;
use App\Events\SubscriptionCancelled;
use App\Events\SubscriptionPaymentFailedEvent;
use App\Events\SubscriptionProlongedEvent;
use App\Events\SubscriptionStartedEvent;
use App\Events\UserPaidAccessFinished;
use App\Events\UserPaidForAccess;
use App\Events\UserRegisteredEvent;
use App\Listeners\Emails\SendEmailAfterRegistrationListener;
use App\Listeners\Excelmailing\SubscriptionCancelledListener;
use App\Listeners\Excelmailing\SubscriptionStartedListener;
use App\Listeners\Excelmailing\UserAccessFinishedListener;
use App\Listeners\Excelmailing\UserAccessListener;
use App\Listeners\Excelmailing\UserRegisteredListener;
use App\Listeners\FollowupsListener;
use App\Listeners\PlanUserExpiredFollowups;
use App\Listeners\PlanUserPaidFollowups;
use App\Listeners\PlanUserRegisteredFollowups;
use App\Listeners\SendSubscriptionFailedEmail;
use App\Listeners\UpdateLastPasswordChange;
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
        UserRegisteredEvent::class            => [
            PlanUserRegisteredFollowups::class,
            SendEmailAfterRegistrationListener::class,
            FollowupsListener::class,
            UserRegisteredListener::class,
        ],
        UserPaidForAccess::class              => [
            PlanUserPaidFollowups::class,
            UserAccessListener::class,
        ],
        UserPaidAccessFinished::class         => [
            PlanUserExpiredFollowups::class,
            UserAccessFinishedListener::class,
        ],
        OrderLeft24hAgo::class                => [
            //
        ],
        OrderLeft72hAgo::class                => [
            //
        ],
        SubscriptionCancelled::class          => [
            SendSubscriptionFailedEmail::class,
            SubscriptionCancelledListener::class,
        ],
        SubscriptionStartedEvent::class       => [
            FollowupsListener::class,
            SubscriptionStartedListener::class,
        ],
        SubscriptionProlongedEvent::class     => [
            FollowupsListener::class,
        ],
        ActiveSubscriptionExpiredEvent::class => [
            TryToProlongSubscriptionListener::class,
        ],
        SubscriptionPaymentFailedEvent::class => [
            FollowupsListener::class,
        ],
        PasswordReset::class                  => [
            UpdateLastPasswordChange::class,
        ],
        FirstPaymentCorrectEvent::class       => [
            StartSubscriptionAfterFirstPaymentListener::class,
            FollowupsListener::class,
        ],
        NewAccessGrantedEvent::class          => [
            FollowupsListener::class,
        ],
        FullAccessGrantedEvent::class         => [
            UserAccessListener::class,
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
