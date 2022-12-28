<?php
namespace App\Domains\Integrations\Mailerlite\Listeners;

use App\Domains\Admin\Helpers\SettingsHelper;
use App\Domains\Quicksales\Integrations\MailerliteService;
use App\Events\AutomaticSubscriptionStartedEvent;
use App\User;
use Illuminate\Support\Facades\Log;

class SubscribeUserToMailerliteGroupListener
{
    public function handle(AutomaticSubscriptionStartedEvent $event): void
    {
        $user = $event->subscription->user;

        if ($user === null) {
            Log::error('MAILERLITE - NO USER', );
            return;
        }

        $groupId = setting(SettingsHelper::STRIPE_MAILERLITE);

        if (empty($groupId)) {
            Log::error('MAILERLITE - NO GROUP');
            return;
        }

        /** @var MailerliteService|null $service */
        $service = app(MailerliteService::class);
        if ($service === null) {
            Log::error('MAILERLITE - NO SERVICE');
            return;
        }

        $this->trySubscribeUser($service, $user, $groupId);
    }

    protected function trySubscribeUser(MailerliteService $service, User $user, $groupId): void
    {
        try {
            $service->addUserToGroup($user, $groupId);
        } catch (\Exception $exception) {
            Log::error("[MAILERLITE] Could not subscribe user {$user->id} to group {$groupId}");
        }
    }
}
