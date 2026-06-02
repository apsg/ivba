<?php
namespace App\Domains\Api\Listeners;

use App\Domains\Api\Events\CourseAccessGrantedEvent;
use App\Domains\Api\Mails\AccessGrantedMail;
use Illuminate\Support\Facades\Mail;

class SendAccessInfoEmailListener
{
    public function handle(CourseAccessGrantedEvent $event)
    {
        if (config('app.name') == 'techniczni.pro') {
            return;
        }

        Mail::to($event->user)
            ->send(new AccessGrantedMail());
    }
}
