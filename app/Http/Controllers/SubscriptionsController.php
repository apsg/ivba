<?php
namespace App\Http\Controllers;

use App\Domains\Admin\Models\Setting;
use App\Http\Requests\Axios\CheckCouponRequest;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Payments\PaymentService;
use App\Repositories\PaymentRepository;
use App\Repositories\SubscriptionRepository;
use App\Subscription;
use Auth;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('checkCoupon');
    }

    public function create(
        CreateSubscriptionRequest $request,
        SubscriptionRepository $subscriptionRepository,
        PaymentRepository $paymentRepository,
        PaymentService $paymentService
    ) {
        $subscription = $subscriptionRepository->create(Auth::user(), $request->coupon());

        $payment = $paymentRepository->createFirst($subscription);

        $url = $paymentService->payUrl($payment);

        return redirect($url);
    }

    /**
     * Anuluj abonament.
     */
    public function cancel(Subscription $subscription)
    {
        if ($subscription->user_id == Auth::user()->id) {
            $subscription->cancel();
            flash('Anulowano subskrypcję');
        } else {
            flash('Nie możesz tego zrobić');
        }

        return back();
    }

    public function checkCoupon(CheckCouponRequest $request)
    {
        if ($request->coupon() === null) {
            return response()->json([
                'message' => 'Nie ma takiego kuponu',
            ], 404);
        }

        if (! $request->coupon()->isSubscription()) {
            return response()->json(['message' => 'Zły typ kuponu'], 422);
        }

        if ($request->coupon()->uses_left === 0) {
            return response()->json([
                'message' => 'Ten kupon się wyczerpał',
            ], 403);
        }

        return [
            'price' => sprintf('%.2f',
                $request->coupon()->apply(Setting::get('ivba.subscription_price'))
            ),
        ];
    }
}
