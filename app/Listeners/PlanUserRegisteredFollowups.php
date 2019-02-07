<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlanUserRegisteredFollowups
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
     * @param  UserRegisteredEvent $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        $fcs = \App\FollowupContent::where('event', $event::EVENTNAME )->get();

        foreach ($fcs as $fc) {
            $fc->followups()->create([
                    'user_id' => $event->user->id,
                    'send_at' => \Carbon\Carbon::now()->add( $fc->interval ),
                ]);
        }

    }
}
