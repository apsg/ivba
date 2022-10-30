<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Requests\QuickFullAccessRequest;
use App\Http\Controllers\Controller;
use App\Payments\PaymentService;
use App\Repositories\PaymentRepository;
use App\Repositories\SubscriptionRepository;

class QuickSubscriptionController extends Controller
{
    public function create(
        QuickFullAccessRequest $request,
        SubscriptionRepository $subscriptionRepository,
        PaymentRepository $paymentRepository,
        PaymentService $paymentService
    ) {
        $subscription = $subscriptionRepository->create($request->resolveUser(), $request->coupon());
        $payment = $paymentRepository->createFirst($subscription);
        $url = $paymentService->payUrl($payment);

        return [
            'url' => $url,
        ];
    }
}
