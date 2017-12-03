<?php

namespace App\Listeners;

use App\Events\UserPaidAccessFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlanUserExpiredFollowups
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
     * @param  UserPaidAccessFinished  $event
     * @return void
     */
    public function handle(UserPaidAccessFinished $event)
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
