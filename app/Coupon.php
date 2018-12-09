<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    const TYPE_VALUE = 1;
    const TYPE_PERCENT = 2;

    const TYPE_SUBSCRIPTION_VALUE = 3;
    const TYPE_SUBSCRIPTION_PERCENT = 4;

    /**
     * Zamówienia, do których użyto tego kodu
     * @return [type] [description]
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Zastosuj kupon i zwróć cenę po obniżce
     * @param  [type] $total [description]
     * @return [type]        [description]
     */
    public function apply($total)
    {
        if ($this->uses_left <= 0) {
            return $total;
        }

        if ($this->type == static::TYPE_VALUE || $this->type == static::TYPE_SUBSCRIPTION_VALUE) {
            // Kupon złotowy
            return max(0, $total - $this->amount);
        } elseif ($this->type == static::TYPE_PERCENT || $this->type == static::TYPE_SUBSCRIPTION_PERCENT) {
            // kupon procentowy
            return max(0, (100 - $this->amount) * $total / 100);
        }
    }

    /**
     * Zwraca link usuwania z koszyka
     * @param  Order $order [description]
     * @return [type]            [description]
     */
    public function removeLink(Order $order)
    {
        return url('/order/' . $order->id . '/remove_coupon/' . $this->id);
    }

    /**
     * Zwraca sformatowaną wartość kuponu
     * @return [type] [description]
     */
    public function valueFormatted()
    {
        return $this->amount . ($this->type == static::TYPE_VALUE ? ' PLN' : ' %');
    }

    /**
     * Zwraca link edycji kuponu
     * @return [type] [description]
     */
    public function editLink()
    {
        return url('/admin/coupon/' . $this->id);
    }

    /**
     * Zwraca link usuwania kuponu
     * @return [type] [description]
     */
    public function deleteLink()
    {
        return url('/admin/coupon/' . $this->id . '/delete');
    }

    public function getTypeTextAttribute()
    {
        if ($this->type === static::TYPE_VALUE) {
            return "Złotowy";
        }

        if ($this->type === static::TYPE_PERCENT) {
            return "Procentowy";
        }

        if ($this->type === static::TYPE_SUBSCRIPTION_VALUE) {
            return "Złotowy - subskrypcje";
        }

        if ($this->type === static::TYPE_SUBSCRIPTION_PERCENT) {
            return "Procentowy - subskrypcje";
        }

        return 'nieznany';
    }
}
