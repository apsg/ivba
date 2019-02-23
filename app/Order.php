<?php
namespace App;

use App\Events\UserPaidForAccess;
use App\Notifications\OrderConfirmed;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 *
 * @property string|null external_payment_id
 * @property Carbon      confirmed_at
 * @property-read User   user
 */
class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Użytkownik, który wygenerował zamówienie
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


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
     */
    public function sum() : float
    {
        return $this->is_full_access ? $this->price : 0;
    }

    /**
     * Suma końcowa
     */
    public function total() : float
    {
        $total = $this->sum();
        foreach ($this->coupons as $coupon) {
            $total = $coupon->apply($total);
        }

        return $total;
    }

    /**
     * Kwota netto
     */
    public function netto() : float
    {
        return number_format($this->total() / 1.23, 2);
    }

    /**
     * Kwota podatku
     */
    public function tax() : float
    {
        return $this->total() - $this->netto();
    }

    /**
     * Potwierdź zamówienie
     */
    public function confirm(string $externalId = null) : bool
    {
        if (!is_null($this->confirmed_at)) {
            return false;
        }

        $this->confirmed_at = Carbon::now();
        $this->external_payment_id = $externalId;

        if ($this->is_full_access) {
            $this->user->updateFullAccess($this->duration);
        } else {
            // and nothing else matters...
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

    public function isEmpty() : bool
    {
        if ($this->is_full_access) {
            return false;
        }

        return true;
    }


    public function scopeConfirmed($query)
    {
        $query->where(function ($q) {
            $q->whereNotNull('confirmed_at')
                ->orWhereNotNull('external_payment_id');
        });
    }
}
