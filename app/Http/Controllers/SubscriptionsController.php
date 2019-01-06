<?php
namespace App\Http\Controllers;

use App\Payment;
use App\Payments\PaymentService;
use App\Repositories\SubscriptionRepository;
use App\Subscription;
use Auth;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(SubscriptionRepository $subscriptionRepository, PaymentService $paymentService)
    {
        $subscription = $subscriptionRepository->create(Auth::user());

        $payment = Payment::create([
            'subscription_id' => $subscription->id,
            'amount'          => config('ivba.subscription_price_first'),
            'is_recurrent'    => false,
            'title'           => config('ivba.subscription_description_first'),
        ]);

        $url = $paymentService->payUrl($payment, Auth::user());

        return redirect($url);
    }

    /**
     * Anuluj abonament
     * @param  Subscription $subscription [description]
     * @return [type]                     [description]
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
}
