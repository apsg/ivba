<?php

namespace App\Listeners;

use App\Events\UserPaidForAccess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlanUserPaidFollowups
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
     * @param  UserPaidForAccess  $event
     * @return void
     */
    public function handle(UserPaidForAccess $event)
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
