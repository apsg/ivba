<?php
namespace App\Payments\Drivers;

use App\Payment;
use App\Payments\StripeHelper;
use App\Subscription;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\PaymentLink;
use Stripe\StripeClient;

class StripeDriver
{
    protected StripeClient $client;

    public function __construct()
    {
        $this->client = new StripeClient(config('stripe.sk'));
    }

    public function createSubscriptionLink(Payment $payment): string
    {
        $plan = $this->createPlan($payment);
        $returnUrl = route('account.show');
        $userId = $payment->getUser()->id;

        $session = Session::create([
            'payment_method_types' => ['card'],
            'subscription_data'    => [],
            'line_items'           => [
                [
                    'price'    => $plan,
                    'quantity' => 1,
                ],
            ],
            'mode'                 => 'subscription',
            'success_url'          => $returnUrl,
            'cancel_url'           => $returnUrl,
            'customer_email'       => $payment->getUser()->email,
            'metadata'             => [
                'user_id'    => $userId,
                'payment_id' => $payment->id,
            ],
            'client_reference_id'  => $userId,
        ]);

        return $session->url;
    }

    protected function createPlan(Payment $payment): string
    {
        $plan = $this->client->plans->create([
            'amount'   => StripeHelper::priceToCents($payment->subscription->amount),
            'currency' => 'PLN',
            'interval' => 'month',
            'product'  => config('stripe.subscription_product'),
            'metadata' => [
                'user_id'    => $payment->getUser()->id,
                'payment_id' => $payment->id,
                'user_email' => $payment->getEmail(),
            ],
        ]);

        $payment->subscription->update([
            'stripe_plan_id' => $plan->id,
        ]);

        return object_get($plan, 'id');
    }

    public function cancelSubscription(Subscription $subscription): void
    {
        if (empty($subscription->stripe_subscription_id)) {
            return;
        }

        $this->client->subscriptions->cancel($subscription->stripe_subscription_id);
    }

    public function getIntent(string $intentId): PaymentIntent
    {
        return $this->client->paymentIntents->retrieve($intentId);
    }

    public function getSession(string $paymentId)
    {
        return $this->client->checkout->sessions->retrieve($paymentId)->line_items;
    }

    public function getPaymentLink(string $id): PaymentLink
    {
        return $this->client->paymentLinks->retrieve($id);
    }
}
