<?php

namespace App;

use App\Interfaces\iOrderable;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model 
{
    
    protected $guarded = [];


    protected $casts = [
    	'next_payment_at' => 'date',
    ];

    /**
     * Uzytkownik, do którego należy ten abonament
     * @return [type] [description]
     */
    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Anuluj subskrypcję
     * @return [type] [description]
     */
    public function cancel(){

        if(is_null($this->cancelled_at)){
        	$this->update([
        		'cancelled_at' => \Carbon\Carbon::now(),
        	]);

            event(new \App\Events\SubscriptionCancelled($this));
        }

        return $this;
    }

}
