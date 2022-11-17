<?php
namespace App\Domains\Payments\Dtos\Stripe;

use App\Payments\Drivers\StripeDriver;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;

class PaymentIntentDto
{
    protected array $data;

    public function __construct(array $data = [])
    {
        $this->data = Arr::get($data, 'data.object');
        Log::info(__CLASS__, $this->data);
    }

    public function getIntentId(): string
    {
        return Arr::get($this->data, 'id');
    }

    public function isSucceeded(): bool
    {
        return Arr::get($this->data, 'status') === PaymentIntent::STATUS_SUCCEEDED;
    }

    public function getPaymentIntent()
    {
        return app(StripeDriver::class)->getIntent($this->getIntentId());
    }
}
