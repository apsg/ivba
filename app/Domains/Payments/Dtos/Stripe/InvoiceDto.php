<?php
namespace App\Domains\Payments\Dtos\Stripe;

use App\Payments\StripeHelper;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class InvoiceDto
{
    protected array $data;

    public function __construct(array $data = [])
    {
        $this->data = Arr::get($data, 'data.object');
        Log::info(__CLASS__, $this->data);
    }

    public function getSubscriptionId(): string
    {
        $subscriptionId =  Arr::get($this->data, 'subscription');

        if (empty($subscriptionId)) {
            $subscriptionId = Arr::get($this->data, 'parent.subscription_details.subscription');
        }

        return $subscriptionId;
    }

    public function getPlanId(): string
    {
        return Arr::get($this->data, 'lines.data.0.plan.id', '');
    }

    public function getPlanAmount(): float
    {
        return StripeHelper::centsToPrice(Arr::get($this->data, 'lines.data.0.plan.amount', 0));
    }

    public function isPaid(): bool
    {
        return Arr::get($this->data, 'paid', false);
    }

    public function getInvoiceId(): string
    {
        return Arr::get($this->data, 'id');
    }

    public function getPeriodEnd(): ?Carbon
    {
        $timestamp = Arr::get($this->data, 'lines.data.0.period.end');

        if ($timestamp === null) {
            return null;
        }

        return Carbon::createFromTimestamp($timestamp);
    }

    public function getAmount(): float
    {
        return StripeHelper::centsToPrice(Arr::get($this->data, 'amount_paid', 0));
    }

    public function getProductId(): ?string
    {
        $product = Arr::get($this->data, 'lines.data.0.plan.product');

        if (empty($product)) {
            $product = Arr::get($this->data, 'lines.data.0.pricing.price_details.product');
        }

        return $product;
    }

    public function getEmail(): ?string
    {
        return Arr::get($this->data, 'customer_email');
    }

    public function getName(): ?string
    {
        return Arr::get($this->data, 'customer_name');
    }
}
