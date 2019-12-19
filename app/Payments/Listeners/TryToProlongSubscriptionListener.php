<?php
namespace App\Payments\Listeners;

use App\Events\ActiveSubscriptionExpiredEvent;
use App\Payments\Exceptions\PaymentException;
use App\Payments\Tpay\RecurrentPaymentGate;
use App\Repositories\PaymentRepository;
use App\Repositories\SubscriptionRepository;
use tpayLibs\src\_class_tpay\Utilities\TException;

class TryToProlongSubscriptionListener
{
    /** @var SubscriptionRepository */
    protected $subscriptionRepository;

    public function __construct()
    {
        $this->subscriptionRepository = app(SubscriptionRepository::class);
    }

    public function handle(ActiveSubscriptionExpiredEvent $event)
    {
        try {
            $payment = app(PaymentRepository::class)
                ->createRecurrent($event->subscription);

            \Log::info(__CLASS__, [
                'user'    => $event->subscription->user_id,
                'payment' => $payment->id,
            ]);

            (new RecurrentPaymentGate())
                ->init(
                    config('ivba.subscription_description'),
                    $event->subscription->token,
                    $payment
                )->payBySavedCreditCard();

            $subscription = $this->subscriptionRepository->prolong($event->subscription);

            \Log::info('SUBSCRIPTION PROLONGED', [
                'subscription' => $subscription->id,
                'valid_until'  => $subscription->valid_until,
            ]);

        } catch (PaymentException $exception) {
            $this->subscriptionRepository->tryFailed($event->subscription);
        } catch (TException $exception) {
            $this->subscriptionRepository->tryFailed($event->subscription);
        }
    }
}
