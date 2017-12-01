<?php

namespace App\Helpers;


use App\Order;

class Payment{
	
	public function __construct(){
    	\OpenPayU_Configuration::setEnvironment(config('payu.environment')); // sandbox

	    //set POS ID and Second MD5 Key (from merchant admin panel)
	    \OpenPayU_Configuration::setMerchantPosId(config('payu.posid'));
	    \OpenPayU_Configuration::setSignatureKey(config('payu.key2'));
	    
	    //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
	    \OpenPayU_Configuration::setOauthClientId( config('payu.posid') );
	    \OpenPayU_Configuration::setOauthClientSecret( config('payu.key1') );
	    \OpenPayU_Configuration::setOauthTokenCache(new \OauthCacheFile(storage_path('cache')));

	}

	/**
	 * Wygeneruj link przekierowujący do płatności
	 * @return [type] [description]
	 */
	public function getUrl(Order $order){
		$payu['notifyUrl'] = url( '/payu/notify' );
	    $payu['continueUrl'] = url( 'continue?order=' . $order->id );

	    $payu['customerIp'] = request()->ip();
	    $payu['merchantPosId'] = \OpenPayU_Configuration::getMerchantPosId();
	    $payu['description'] = 'Zamówienie na iExcel.pl';
	    $payu['currencyCode'] = 'PLN';
	    $payu['totalAmount'] = 100*$order->total();
	    $payu['extOrderId'] = $order->id . '_' . uniqid();

	    $order->final_total = $order->total();
	    $order->payu_order_id = $payu['extOrderId'];

	    if($order->is_full_access){
		    $payu['products'][0]['name'] = 'Pełny roczny dostęp do platformy iExcel';
		    $payu['products'][0]['unitPrice'] = 100*config('app.full_access_price');
		    $payu['products'][0]['quantity'] = 1;
	    }else{
	    	foreach($order->courses as $course){
			    $item['name'] = $course->cartName();
			    $item['unitPrice'] = 100*$course->price;
			    $item['quantity'] = 1;
			    $payu['products'][] = $item;
	    	}

	    	foreach($order->lessons as $lesson){
			    $item['name'] = $lesson->cartName();
			    $item['unitPrice'] = 100*$lesson->price;
			    $item['quantity'] = 1;
			    $payu['products'][] = $item;
	    	}
	    }

	    $payu['buyer']['email'] = \Auth::user()->email;

	    $response = \OpenPayU_Order::create($payu);
	    $order->save();

	    return $response->getResponse()->redirectUri;
	}

}