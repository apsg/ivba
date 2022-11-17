<?php
namespace App\Domains\Payments\Requests\Stripe;

use Illuminate\Foundation\Http\FormRequest;
use Stripe\Invoice;

class StripeIpnRequest extends FormRequest
{
    const TYPE_INVOICE_PAID = 'invoice.paid';
    const TYPE_INVOICE_SUCCEEDED = 'invoice.payment_succeeded';
    const PAYMENT_INTENT_SUCCEEDED = 'payment_intent.succeeded';

    public function rules(): array
    {
        return [];
    }

    public function isInvoicePaid(): bool
    {
        return $this->input('type') === static::TYPE_INVOICE_PAID;
    }

    public function isPaymentIntentSucceeded(): bool
    {
        return $this->input('type') === static::PAYMENT_INTENT_SUCCEEDED;
    }
}
