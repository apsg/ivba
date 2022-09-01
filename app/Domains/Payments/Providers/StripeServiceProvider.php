<?php
namespace App\Domains\Payments\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Stripe::setApiKey(config('stripe.sk'));
    }
}
