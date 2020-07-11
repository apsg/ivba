<?php
namespace App\Listeners\Emails;

use App\Events\UserRegisteredEvent;

class SendEmailAfterRegistrationListener
{
    public function handle(UserRegisteredEvent $event)
    {
        // Todo add email
    }
}
