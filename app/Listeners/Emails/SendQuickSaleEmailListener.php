<?php
namespace App\Listeners\Emails;

use App\Email;
use App\Events\QuickSaleConfirmedEvent;
use App\User;
use Carbon\Carbon;

class SendQuickSaleEmailListener
{
    public function handle(QuickSaleConfirmedEvent $event)
    {
        $email = Email::create([
            'from'    => $event->quicksale->message_email,
            'send_at' => Carbon::now(),
            'title'   => $event->quicksale->message_subject,
            'body'    => nl2br($event->quicksale->message_body),
            'type'    => Email::SINGLE,
            'to_id'   => $event->user->id,
            'to_type' => User::class,
        ]);

        $email->send();
    }
}
