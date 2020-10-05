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
            'from'    => $this->getEmail($event),
            'send_at' => Carbon::now(),
            'title'   => $this->getSubject($event),
            'body'    => nl2br($event->quicksale->message_body),
            'type'    => Email::SINGLE,
            'to_id'   => $event->user->id,
            'to_type' => User::class,
        ]);

        $email->send();
    }

    public function getEmail(QuickSaleConfirmedEvent $event)
    {
        if (empty($event->quicksale->message_email)) {
            return config('mail.from.address');
        }

        return $event->quicksale->message_email;
    }

    public function getSubject(QuickSaleConfirmedEvent $event) : string
    {
        if (empty($event->quicksale->message_subject)) {
            return $event->quicksale->name;
        }

        return $event->quicksale->message_subject;
    }
}
