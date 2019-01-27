<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;

class SubscriptionProlongedEvent extends BaseSubscriptionEvent
{
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
