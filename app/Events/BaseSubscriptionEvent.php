<?php
namespace App\Events;

use App\Subscription;

class BaseSubscriptionEvent
{
    /** @var Subscription */
    public $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }
}