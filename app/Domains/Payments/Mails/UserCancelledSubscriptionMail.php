<?php
namespace App\Domains\Payments\Mails;

use App\Subscription;
use Illuminate\Mail\Mailable;

class UserCancelledSubscriptionMail extends Mailable
{
    public Subscription $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this
            ->markdown('common.mails.subscriptioncancelled')
            ->subject('Użytkownik anulował subskrypcję ' . config('app.name'));
    }
}
