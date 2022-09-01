<?php
namespace App\Domains\Payments\Requests\Stripe;

use Illuminate\Foundation\Http\FormRequest;

class StripeIpnRequest extends FormRequest
{
    const TYPE_INVOICE_PAID = 'invoice.paid';

    public function rules(): array
    {
        return [];
    }

    public function isInvoicePaid(): bool
    {
        return $this->input('type') === static::TYPE_INVOICE_PAID;
    }
}
