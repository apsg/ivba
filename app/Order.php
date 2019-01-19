<?php
namespace App;

use App\Events\UserPaidForAccess;
use App\Notifications\OrderConfirmed;
use Carbon\Carbon;
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Abonament podpięty do tego zamówienia
     * @return [type] [description]
     */
//    public function subscription()
//    {
//        return $this->morphedByMany(Lesson::class, 'orderable');
//    }

    /**
     * Lista kodów rabatowych dodanych do tego zamówienia
     * @return [type] [description]
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    /**
     * Suma cen elementów (przed ewentualnymi rabatami)
     * @return [type] [description]
     */
    public function sum()
    {
        return $this->is_full_access ? $this->price : 0;
    }

    /**
     * Suma końcowa
     * @return [type] [description]
     */
    public function total()
    {
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
    public function netto()
    {
        return number_format($this->total() / 1.23, 2);
    }

    /**
     * Kwota podatku
     * @return [type] [description]
     */
    public function tax()
    {
        return $this->total() - $this->netto();
    }

    /**
     * Potwierdź zamówienie
     * @return [type] [description]
     */
    public function confirm()
    {
        if (!is_null($this->confirmed_at)) {
            return false;
        }

        $this->confirmed_at = Carbon::now();

        if ($this->is_full_access) {
            $this->user->updateFullAccess($this->duration);
        } else {

            $this->user->addSubscriptionDays($this->duration);
            $this->user->currentSubscription()->update([
                'is_active'       => true,
                'next_payment_at' => $this->user->lastDay(),
            ]);
        }

        // "Skasuj" wszystkie użyte kody rabatowe w tym zamówieniu
        foreach ($this->coupons as $coupon) {
            $coupon->uses_left -= 1;
            $coupon->save();
        }

        $this->save();

        // Odpalamy zdarzenie
        event(new UserPaidForAccess($this->user));

        // Powiadamiamy użytkownika
        $this->user->notify(new OrderConfirmed($this));

        return true;
    }

    public function isEmpty()
    {
        if ($this->is_full_access) {
            return false;
        }

        return true;
    }
}
