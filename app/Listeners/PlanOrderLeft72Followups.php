<?php

namespace App\Listeners;

use App\Events\OrderLeft72hAgo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlanOrderLeft72Followups
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
     * @param  OrderLeft72hAgo  $event
     * @return void
     */
    public function handle(OrderLeft72hAgo $event)
    {
        $fcs = \App\FollowupContent::where('event', $event::EVENTNAME)->get();

        foreach ($fcs as $fc) {
            $fc->followups()->create([
                    'user_id' => $event->user->id,
                    'send_at' => \Carbon\Carbon::now()->add($fc->interval),
                ]);
        }
    }
}
