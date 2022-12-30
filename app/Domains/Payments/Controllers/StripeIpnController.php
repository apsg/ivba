<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Dtos\Stripe\InvoiceDto;
use App\Domains\Payments\Requests\Stripe\StripeIpnRequest;
use App\Domains\Payments\Services\AutomaticSubscriptionService;
use App\Http\Controllers\Controller;
use App\Payments\Exceptions\UnknownSubscriptionException;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Log;

class StripeIpnController extends Controller
{
    public function __invoke(StripeIpnRequest $request)
    {
        if ($request->isInvoicePaid()) {
            return $this->handleInvoiceEvent($request);
        }

        if ($request->isPaymentIntentSucceeded()) {
            return $this->handlePaymentIntentEvent($request);
        }

        return response('ok', 200);
    }

    protected function handleInvoiceEvent(StripeIpnRequest $request)
    {
        $invoiceDto = new InvoiceDto($request->all());

        Log::info(__CLASS__, [
            'paid'         => $invoiceDto->isPaid(),
            'period_end'   => $invoiceDto->getPeriodEnd()->format('Y-m-d'),
            'plan'         => $invoiceDto->getPlanId(),
            'subscription' => $invoiceDto->getSubscriptionId(),
            'invoice'      => $invoiceDto->getInvoiceId(),
            'product'      => $invoiceDto->getProductId(),
            'email'        => $invoiceDto->getEmail(),
        ]);

        try {
            app(SubscriptionRepository::class)->activateOrProlongFromStripe($invoiceDto);
        } catch (UnknownSubscriptionException $exception) {
            app(AutomaticSubscriptionService::class)->trySubscribe($invoiceDto);
        }

        return response('ok', 200);
    }

    protected function handlePaymentIntentEvent(StripeIpnRequest $request)
    {
        return response('ok', 200);
    }
}
