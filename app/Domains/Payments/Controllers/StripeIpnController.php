<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Dtos\Stripe\InvoiceDto;
use App\Domains\Payments\Requests\Stripe\StripeIpnRequest;
use App\Http\Controllers\Controller;
use App\Payments\Exceptions\UnknownSubscriptionException;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Log;

class StripeIpnController extends Controller
{
    public function __invoke(StripeIpnRequest $request)
    {
        Log::info(__CLASS__, $request->all());

        if (!$request->isInvoicePaid()) {
            return response('ok', 200);
        }

        $invoiceDto = new InvoiceDto($request->all());

        Log::info(__CLASS__, [
            'paid'         => $invoiceDto->isPaid(),
            'period_end'   => $invoiceDto->getPeriodEnd()->format('Y-m-d'),
            'plan'         => $invoiceDto->getPlanId(),
            'subscription' => $invoiceDto->getSubscriptionId(),
            'invoice'      => $invoiceDto->getInvoiceId(),
        ]);

        try {
            app(SubscriptionRepository::class)->activateOrProlongFromStripe($invoiceDto);
        } catch (UnknownSubscriptionException $exception) {
            Log::error(UnknownSubscriptionException::class, [
                'message' => $exception->getMessage(),
            ]);
        }

        return response('ok', 200);
    }
}
