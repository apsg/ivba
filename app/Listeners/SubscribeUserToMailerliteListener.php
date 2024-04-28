<?php
namespace App\Listeners;

use App\Domains\Admin\Helpers\SettingsHelper;
use App\Domains\Quicksales\Integrations\MailerliteService;
use App\Events\UserRegisteredEvent;
use Illuminate\Support\Facades\Log;

class SubscribeUserToMailerliteListener
{
    public function handle(UserRegisteredEvent $event)
    {
        try {
            app(MailerliteService::class)->addUserToGroup($event->user, setting(SettingsHelper::STRIPE_MAILERLITE));
        } catch (\Exception $exception) {
            Log::error('MAILERLITE EXCEPTION ' . $exception->getMessage());
        }
    }
}
