<?php
namespace App\Payments\Listeners;

use App\Events\FirstPaymentCorrectEvent;
use App\Payments\Exceptions\PaymentException;
use App\Repositories\SubscriptionRepository;

class StartSubscriptionAfterFirstPaymentListener
{
    /** @var SubscriptionRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = app(SubscriptionRepository::class);
    }

    public function handle(FirstPaymentCorrectEvent $event)
    {
        try {
            $event->payment->load('subscription');

            $this->repository->makeActive($event->payment->subscription, $event->payment->external_id);
        } catch (PaymentException $exception) {
            $this->repository->grantAccessDays(
                $event->payment->subscription,
                config('ivba.subscription_duration_first')
            );
        }
    }
}