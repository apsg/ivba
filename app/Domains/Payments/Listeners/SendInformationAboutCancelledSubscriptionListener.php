<?php
namespace App\Domains\Payments\Listeners;

use App\Domains\Payments\Mails\UserCancelledSubscriptionMail;
use App\Events\SubscriptionCancelled;
use App\Payments\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendInformationAboutCancelledSubscriptionListener
{
    public function handle(SubscriptionCancelled $event)
    {
        if (!PaymentService::isDriverStripe()) {
            return;
        }

//        try {
            Mail::to(['mateusz.gr@gmail.com'])
                ->send(new UserCancelledSubscriptionMail($event->subscription));
//        } catch (Throwable $exception) {
//            Log::error(__CLASS__, [
//                'message' => $exception->getMessage(),
//            ]);
//        }
    }
}
