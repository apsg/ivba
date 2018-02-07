<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\UserRegistered::class => [
            'App\Listeners\PlanUserRegisteredFollowups',
        ],
        \App\Events\UserPaidForAccess::class => [
            'App\Listeners\PlanUserPaidFollowups',
        ],
        \App\Events\UserPaidAccessFinished::class => [
            'App\Listeners\PlanUserExpiredFollowups',
        ],
        'App\Events\OrderLeft24hAgo' => [
            'App\Listeners\PlanOrderLeft24Followups',
        ],
        'App\Events\OrderLeft72hAgo' => [
            'App\Listeners\PlanOrderLeft72Followups',
        ],
        'App\Events\SubscriptionCancelled' => [
            'App\Listeners\SendSubscriptionFailedEmail',
        ],
        \Illuminate\Auth\Events\PasswordReset::class => [
            'App\Listeners\UpdateLastPasswordChange',
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
