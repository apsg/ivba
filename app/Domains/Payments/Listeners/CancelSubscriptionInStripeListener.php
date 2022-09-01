<?php
namespace App\Domains\Payments\Listeners;

use App\Events\SubscriptionCancelled;
use App\Payments\Drivers\StripeDriver;
use App\Payments\PaymentService;
use Illuminate\Support\Facades\Log;
use Throwable;

class CancelSubscriptionInStripeListener
{
    public function handle(SubscriptionCancelled $event)
    {
        if (!PaymentService::isDriverStripe()) {
            return;
        }

        try {
            app(StripeDriver::class)->cancelSubscription($event->subscription);
        } catch (Throwable $exception) {
            Log::error(__CLASS__, [
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
