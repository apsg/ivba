<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Helpers\PayPalHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    
	/**
	 * Udany checkout
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function checkoutSuccess(Request $request){

		if($request->mode == 'recurring'){
			$provider = \PayPal::setProvider('express_checkout');
			$response = $provider->getExpressCheckoutDetails($request->token);
			
			$startdate = Carbon::now()->toAtomString();
			$profile_desc = config('ivba.subscription_description');

			$data = [
			    'PROFILESTARTDATE' => $startdate,
			    'DESC' => $profile_desc,
			    'BILLINGPERIOD' => 'Month', 
			    'BILLINGFREQUENCY' => config('ivba.subscription_duration'), 
			    'AMT' => config('ivba.subscription_price'), 
			    'CURRENCYCODE' => 'PLN', 
			    'TRIALBILLINGPERIOD' => 'Day',  
			    'TRIALBILLINGFREQUENCY' => config('ivba.subscription_duration_first'), 
			    'TRIALTOTALBILLINGCYCLES' => 1, 
			    'TRIALAMT' => config('ivba.subscription_price_first'), 
			];

			$response = $provider->createRecurringPaymentsProfile($data, $request->token);
			
			if($date = PayPalHelper::getNextDate($response['PROFILEID'])){
    
				\Auth::user()->subscriptions->each->cancel();

				$sub = Subscription::create([
					'user_id'	=> \Auth::user()->id,
					'profileid' => $response['PROFILEID'],
					'is_active' => true,
					'valid_until' => $date->addDays(2),
				]);

				$sub->user->addSubscriptionDaysUntil($date);
			}
			flash('Subskrypcja aktywowana.');
			// return $response;

		}

		return redirect('/account');
	}


	/**
	 * [create description]
	 * @return [type] [description]
	 */
	public function create(){

		$data = [];

		$data['items'] = [
		    [
		        'name'  => config('ivba.subscription_description_first'),
		        'price' => config('ivba.subscription_price_first'),
		        'qty'   => 1,
		    ],
		];

		$data['subscription_desc'] = config('ivba.subscription_description');
		$data['invoice_id'] = 1;
		$data['invoice_description'] = config('ivba.subscription_description');
		$data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring');
		$data['cancel_url'] = url('/');

		$data['total'] = config('ivba.subscription_price_first');

		$provider = new ExpressCheckout();
		$response = $provider->setExpressCheckout($data);

		// Use the following line when creating recurring payment profiles (subscriptions)
		$response = $provider->setExpressCheckout($data, true);

		 // This will redirect user to PayPal
		return redirect($response['paypal_link']);

	}

	/**
	 * Co przychodzi z paypala?
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function notify(Request $request){
		\Log::info($request->all());
	}

}
