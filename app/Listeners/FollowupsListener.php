<?php
namespace App\Listeners;

use App\Events\BaseSubscriptionEvent;
use App\Events\FirstPaymentCorrectEvent;
use App\Events\SubscriptionPaymentFailedEvent;
use App\Events\UserRegisteredEvent;
use App\FollowupContent;
use App\Helpers\FollowupsHelper;
use Carbon\Carbon;

class FollowupsListener
{
    public function handle($event)
    {
        $eventName = FollowupsHelper::getName(get_class($event));

        $followupContents = FollowupContent::where('event', $eventName)->get();

        foreach ($followupContents as $content) {
            try {
                $content->followups()->create([
                    'user_id' => $this->getUserId($event),
                    'send_at' => Carbon::now()->add($content->interval),
                ]);
            } catch (\Exception $exception) {
                // Do nothing
            }
        }
    }

    protected function getUserId($event) : int
    {
        if ($event instanceof BaseSubscriptionEvent) {
            return $event->subscription->user_id ?? null;
        }

        if ($event instanceof UserRegisteredEvent) {
            return $event->user->id ?? null;
        }

        if ($event instanceof FirstPaymentCorrectEvent ||
            $event instanceof SubscriptionPaymentFailedEvent) {
            return $event->payment->subscription->user_id ?? null;
        }

        return null;
    }
}
