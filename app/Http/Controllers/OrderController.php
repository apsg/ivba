<?php

namespace App\Http\Controllers;

use App\Order;
use App\Course;
use App\Coupon;
use App\Lesson;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function __construct(){
    	$this->middleware('auth');
    }

    /**
     * Dodaj kurs do zamówienia i przekieruj na stronę koszyka
     * @param  Course $course [description]
     * @return [type]         [description]
     */
    public function orderCourse(Course $course){
    	$order = \Auth::user()->getCurrentOrder();

    	$order->courses()->save($course);

    	return redirect('/cart');
    }

    /**
     * Dodaj lekcję do zamówienia i przekieruj na stronę koszyka
     * @param  Lesson $lesson [description]
     * @return [type]         [description]
     */
    public function orderLesson(Lesson $lesson){
        $order = \Auth::user()->getCurrentOrder();

        if(!$order->lessons()->where('id', $lesson->id)->exists())
            $order->lessons()->attach($lesson);

        return redirect('/cart');
    }

    /**
     * Pokaż koszyk
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showCart(Request $request){
    	$order = \Auth::user()->getCurrentOrder();
    	return view('cart')->with(compact('order'));
    }

    /**
     * Usuń kurs z zamówienia
     * @param  Order  $order     [description]
     * @param  [type] $course_id [description]
     * @return [type]            [description]
     */
    public function removeCourse(Order $order, $course_id){
        $order->courses()->detach($course_id);
        return redirect('/cart');
    }

    /**
     * Usuń lekcję z zamówienia
     * @param  Order  $order     [description]
     * @param  [type] $lesson_id [description]
     * @return [type]            [description]
     */
    public function removeLesson(Order $order, $lesson_id){
        $order->lessons()->detach($lesson_id);
        return redirect('/cart');
    }

    /**
     * Wygeneruj płatność dla tego zamówienia.
     * @param  Order  $order [description]
     * @return [type]        [description]
     */
    public function pay(Order $order){
        if($order->total() > 0){
            $payment = new \App\Helpers\Payment;
            return redirect($payment->getUrl($order));
        }else{
            $order->final_total = 0;
            if($order->confirm())
                return redirect('/continue');
            else
                return redirect('/cart');

        }
    }

    /**
     * Dodaj pełen dostęp do aktualnego zamówienia
     */
    public function addFullAccess(\App\FullAccessOption $option){

        if(\Auth::user()->canAddFullAccess()){
            $order = \Auth::user()->getCurrentOrder();
            $order->is_full_access = true;
            $order->duration = $option->duration;
            $order->price = $option->price;
            $order->save();
        }
        return redirect('/cart');
    }

    /**
     * Usuń pełen dostęp z koszyka
     * @return [type] [description]
     */
    public function removeFullAccess(){
        $order = \Auth::user()->getCurrentOrder();
        $order->is_full_access = false;
        $order->save();

        return redirect('/cart');   
    }

    /**
     * Dodaj kupon do tego zamówienia
     * @param Order   $order   [description]
     * @param Request $request [description]
     */
    public function addCoupon(Order $order, Request $request){
        $code = $request->code;

        $coupon = \App\Coupon::where('code', $code)->first();

        if($coupon){
            if($coupon->uses_left > 0){
                $order->coupons()->save($coupon);
                flash('Kod rabatowy dodany');
            }else{
                flash('Wyczerpano już limit użyć tego kodu rabatowego');
            }
        }else{
            flash('Nie znaleziono kuponu rabatowego o takim kodzie.')->error();
        }

        return back();

    }

    /**
     * Usuń kod rabatowy z koszyka
     * @param  Order  $order  [description]
     * @param  Coupon $coupon [description]
     * @return [type]         [description]
     */
    public function removeCoupon(Order $order, Coupon $coupon){
        $order->coupons()->detach($coupon);
        return back();
    }

}
