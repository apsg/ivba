<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    const ZLOTOWY = 1;
    const PROCENTOWY = 2;

    /**
     * Zamówienia, do których użyto tego kodu
     * @return [type] [description]
     */
    public function orders(){
    	return $this->belongsToMany(\App\Order::class);
    }

    /**
     * Zastosuj kupon i zwróć cenę po obniżce
     * @param  [type] $total [description]
     * @return [type]        [description]
     */
    public function apply($total){
    	if($this->uses_left <= 0){
    		return $total;
    	}
    	
    	if($this->type == static::ZLOTOWY){
	    	// Kupon złotowy
    		return max(0, $total - $this->amount);
    	}elseif($this->type == static::PROCENTOWY){ 
    		// kupon procentowy
    		return max(0, (100-$this->amount)*$total/100 );
    	}
    }

    /**
     * Zwraca link usuwania z koszyka
     * @param  \App\Order $order [description]
     * @return [type]            [description]
     */
    public function removeLink(\App\Order $order){
        return url('/order/'.$order->id.'/remove_coupon/'.$this->id);
    }

    /**
     * Zwraca sformatowaną wartość kuponu
     * @return [type] [description]
     */
    public function valueFormatted(){
        return $this->amount . ( $this->type== static::ZLOTOWY ? ' PLN' : ' %' );
    }

    /**
     * Zwraca link edycji kuponu
     * @return [type] [description]
     */
    public function editLink(){
        return url('/admin/coupon/'.$this->id);
    }

    /**
     * Zwraca link usuwania kuponu
     * @return [type] [description]
     */
    public function deleteLink(){
        return url('/admin/coupon/'.$this->id.'/delete');
    }
}
