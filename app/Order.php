<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    protected $guarded = [];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Użytkownik, który wygenerował zamówienie
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Lista kursów w tym zamówieniu
     * @return [type] [description]
     */
    public function courses(){
    	return $this->morphedByMany(\App\Course::class, 'orderable');
    }

    /**
     * Lista lekcji w tym zamówieniu
     * @return [type] [description]
     */
    public function lessons(){
    	return $this->morphedByMany(\App\Lesson::class, 'orderable');
    }

    /**
     * Lista kodów rabatowych dodanych do tego zamówienia
     * @return [type] [description]
     */
    public function coupons(){
        return $this->belongsToMany(\App\Coupon::class);
    }

    /**
     * Suma cen elementów (przed ewentualnymi rabatami)
     * @return [type] [description]
     */
    public function sum(){
    	return $this->is_full_access ? config('app.full_access_price') : 
            number_format(
                $this->courses->map(function($course){
        		  return $course->price;
        	   })->sum() + $this->lessons->map(function($lesson){
                    return $lesson->price;
               })->sum() , 2);
    }

    /**
     * Suma końcowa
     * @return [type] [description]
     */
    public function total(){
        $total = $this->sum();
        foreach ($this->coupons as $coupon) {
            $total = $coupon->apply($total);
        }
        return $total;
    }

    /**
     * Kwota netto
     * @return [type] [description]
     */
    public function netto(){
        return number_format($this->total() / 1.23, 2);
    }

    /**
     * Kwota podatku
     * @return [type] [description]
     */
    public function tax(){
        return $this->total() - $this->netto();
    }

    /**
     * Potwierdź zamówienie
     * @return [type] [description]
     */
    public function confirm(){

        if(!is_null($this->confirmed_at))
            return false;

        $this->confirmed_at = \Carbon\Carbon::now();

        if($this->is_full_access){
            $this->user->updateFullAccess( config('app.full_access_duration') );
        }else{
            
            // Przyznaj dostęp do kursów
            foreach($this->courses as $course){
                \App\Access::grant(
                    $this->user->id, 
                    $course, 
                    \App\Course::$SUBSCRIPTION_LENGTH
                );
            }

            // Przyznaj dostęp do lekcji
            foreach($this->lessons as $lesson){
                \App\Access::grant(
                    $this->user->id, 
                    $lesson,
                    \App\Lesson::$SUBSCRIPTION_LENGTH
                );
            }
        }

        // "Skasuj" wszystkie użyte kody rabatowe w tym zamówieniu
        foreach ($this->coupons as $coupon) {
            $coupon->uses_left -= 1;
            $coupon->save();
        }

        $this->save();

        // Odpalamy zdarzenie
        event(new \App\Events\UserPaidForAccess($this->user));

        // Powiadamiamy użytkownika
        $this->user->notify( new \App\Notifications\OrderConfirmed($this) );

        return true;
    }


}
