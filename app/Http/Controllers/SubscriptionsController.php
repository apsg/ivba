<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Anuluj abonament
	 * @param  Subscription $subscription [description]
	 * @return [type]                     [description]
	 */
	public function cancel(Subscription $subscription){

		if($subscription->user_id == \Auth::user()->id){
			$subscription->cancel();
			flash('Anulowano subskrypcję');
		}else{
			flash('Nie możesz tego zrobić');
		}

		return back();
	}

}
