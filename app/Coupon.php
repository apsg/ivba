<?php

namespace App;

use App\Exceptions\NoCouponUsesLeftException;
use App\Repositories\AccessRepository;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Coupon
 *
 * @package App
 * @property string                   code
 * @property int                      uses_left
 * @property int                      type
 * @property-read string              type_text
 * @property int                      $id
 * @property float                    amount
 * @property Carbon|null              created_at
 * @property Carbon|null              updated_at
 * @property-read Collection|Order[]  $orders
 * @property-read Collection|Course[] $courses
 * @mixin \Eloquent
 */
class Coupon extends Model
{
    protected $guarded = [];

    const TYPE_VALUE = 1;
    const TYPE_PERCENT = 2;

    const TYPE_SUBSCRIPTION_VALUE = 3;
    const TYPE_SUBSCRIPTION_PERCENT = 4;

    const TYPE_COURSE_ACCESS = 5;

    /**
     * Zamówienia, do których użyto tego kodu
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * Zastosuj kupon i zwróć cenę po obniżce
     */
    public function apply($total)
    {
        if ($this->uses_left <= 0) {
            return $total;
        }

        if ($this->type == self::TYPE_VALUE || $this->type == self::TYPE_SUBSCRIPTION_VALUE) {
            // Kupon złotowy
            return max(0, $total - $this->amount);
        } elseif ($this->type == self::TYPE_PERCENT || $this->type == self::TYPE_SUBSCRIPTION_PERCENT) {
            // kupon procentowy
            return max(0, (100 - $this->amount) * $total / 100);
        }
    }

    /**
     * Zwraca link usuwania z koszyka
     */
    public function removeLink(Order $order)
    {
        return url('/order/' . $order->id . '/remove_coupon/' . $this->id);
    }

    /**
     * Zwraca sformatowaną wartość kuponu
     */
    public function valueFormatted()
    {
        return $this->amount . ($this->type == static::TYPE_VALUE ? ' PLN' : ' %');
    }

    /**
     * Zwraca link edycji kuponu
     */
    public function editLink()
    {
        return url('/admin/coupon/' . $this->id);
    }

    /**
     * Zwraca link usuwania kuponu
     */
    public function deleteLink()
    {
        return url('/admin/coupon/' . $this->id . '/delete');
    }

    public function getTypeTextAttribute()
    {
        if ($this->type == self::TYPE_VALUE) {
            return "Złotowy";
        }

        if ($this->type == self::TYPE_PERCENT) {
            return "Procentowy";
        }

        if ($this->type == self::TYPE_SUBSCRIPTION_VALUE) {
            return "Złotowy - subskrypcje";
        }

        if ($this->type == self::TYPE_SUBSCRIPTION_PERCENT) {
            return "Procentowy - subskrypcje";
        }

        return 'nieznany';
    }

    public function isSubscription()
    {
        if ($this->type == self::TYPE_SUBSCRIPTION_PERCENT) {
            return true;
        }

        if ($this->type == self::TYPE_SUBSCRIPTION_VALUE) {
            return true;
        }

        return false;
    }

    public function use() : self
    {
        if ($this->uses_left <= 0) {
            throw new NoCouponUsesLeftException();
        }

        $this->uses_left -= 1;
        $this->save();

        if ($this->type === static::TYPE_COURSE_ACCESS) {
            $accessRepo = app(AccessRepository::class);
            foreach ($this->courses as $course) {
                $accessRepo->grant(Auth::user(), $course);
            }
        }

        return $this;
    }
}
