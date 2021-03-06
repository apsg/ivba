<?php
namespace App\Repositories;

use App\Events\FirstPaymentCorrectEvent;
use App\Events\FirstPaymentIncorrectEvent;
use App\Events\SubscriptionPaymentFailedEvent;
use App\Payment;
use App\Subscription;
use Carbon\Carbon;

class PaymentRepository
{
    const STATUS_CORRECT = 'correct';
    const STATUS_DECLINED = 'declined';

    public function createFirst(Subscription $subscription) : Payment
    {
        return Payment::create([
            'subscription_id' => $subscription->id,
            'amount'          => setting('ivba.subscription_price_first'),
            'is_recurrent'    => false,
            'title'           => config('ivba.subscription_description_first'),
        ]);
    }

    public function createRecurrent(Subscription $subscription) : Payment
    {
        return Payment::create([
            'subscription_id' => $subscription->id,
            'amount'          => $subscription->amount,
            'is_recurrent'    => true,
            'title'           => config('ivba.subscription_description'),
        ]);
    }

    public function handle($paymentId, string $status = null, array $data = []) : Payment
    {
        /** @var Payment $payment */
        $payment = Payment::findOrFail((int)$paymentId);

        if ($status === static::STATUS_CORRECT) {
            if ($payment->confirmed_at === null) {
                $payment->update([
                    'confirmed_at' => Carbon::now(),
                    'external_id'  => array_get($data, 'cli_auth'),
                ]);

                event(new FirstPaymentCorrectEvent($payment));
            }
        }

        if ($status === static::STATUS_DECLINED) {
            $payment->update([
                'cancelled_at'  => Carbon::now(),
                'cancel_reason' => array_get($data, 'reason'),
            ]);

            event(new FirstPaymentIncorrectEvent($payment));
        }

        return $payment;
    }

    public function confirmRecurrent(Payment $payment) : Payment
    {
        $payment->update([
            'confirmed_at' => Carbon::now(),
        ]);

        return $payment;
    }

    public function rejectRecurrent(Payment $payment, string $reson = null) : Payment
    {
        $payment->update([
            'cancelled_at'  => Carbon::now(),
            'cancel_reason' => $reson,
        ]);

        event(new SubscriptionPaymentFailedEvent($payment));

        return $payment;
    }

    public function attachInvoice(Payment $payment, int $invoiceId) : Payment
    {
        $payment->update([
            'invoice_id' => $invoiceId,
        ]);

        return $payment;
    }

    public function isRecentlyProcessingPayment(Subscription $subscription) : bool
    {
        return Payment::where('subscription_id', $subscription->id)
            ->where('created_at', '>', Carbon::now()->subMinutes(10))
            ->exists();
    }
}
