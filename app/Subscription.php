<?php

namespace App;

use App\Interfaces\iOrderable;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\PayPalHelper;

class Subscription extends Model 
{
    
    const STATUS_ACTIVE = 'Active';
    const STATUS_CANCELLED = 'Cancelled';

    protected $guarded = [];

    protected $casts = [
    	'valid_until' => 'datetime',
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

            $res = PayPalHelper::cancel($this->profileid);

            if(isset($res['ACK']) && $res['ACK'] == 'Success'){

            	$this->update([
            		'cancelled_at' => \Carbon\Carbon::now(),
                    'is_active' => false,
            	]);

                event(new \App\Events\SubscriptionCancelled($this));
            }
        }

        return $this;
    }

    /**
     * Sprawdź status tej subskrypcji
     * @return [type] [description]
     */
    public function check(){

        if($this->status() == static::STATUS_ACTIVE){

            if($date = PayPalHelper::getNextDate($this->profileid)){
                $this->update([
                    'valid_until'   => $date->addDays(1),
                    'tries'         => 0,
                    'is_active'     => true,
                    'cancelled_at'  => null,
                ]);

                $this->user->addSubscriptionDaysUntil($date);

            }else{
                
                if($this->tries > 5){
                    $this->update([
                        'is_active' => false,
                        'cancelled_at' => \Carbon\Carbon::now()
                    ]);

                    PayPalHelper::cancel($this->profileid);
                }else{
                    $this->update([
                        'tries' => $this->tries+1
                    ]);
                }

            }
        }else{
            $this->update([
                'is_active' => false,
                'cancelled_at' => \Carbon\Carbon::now(),
            ]);
        }
        return $this;
    }

    /**
     * Status tej subskrypcji
     * @return [type] [description]
     */
    public function status(){
        return PayPalHelper::getStatus($this->profileid);
    }

    /**
     * Czy dana subskrypcja jest aktywna
     * @return boolean [description]
     */
    public function isValid(){
        return $this->valid_until->isFuture();
    }

}
