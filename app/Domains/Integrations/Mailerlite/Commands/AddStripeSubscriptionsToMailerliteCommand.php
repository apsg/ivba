<?php
namespace App\Domains\Integrations\Mailerlite\Commands;

use App\Domains\Admin\Helpers\SettingsHelper;
use App\Domains\Quicksales\Integrations\MailerliteService;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddStripeSubscriptionsToMailerliteCommand extends Command
{
    protected $signature = 'mailerlite:add';

    public function handle()
    {
        $subscriptions = Subscription::whereNotNull('stripe_subscription_id')
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->with('user')
            ->get();

        /** @var MailerliteService $mailerlite */
        $mailerlite = app(MailerliteService::class);
        $group = setting(SettingsHelper::STRIPE_MAILERLITE);

        /** @var Subscription $subscription */
        foreach ($subscriptions as $subscription) {
            $this->info("Adding {$subscription->user->email}");
            $mailerlite->addUserToGroup($subscription->user, $group);
        }
    }
}