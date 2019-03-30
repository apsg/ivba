<?php
namespace App;

use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Subscription
 *
 * @property int                       user_id
 * @property int                       coupon_id
 * @property string                    profileid
 * @property bool                      is_active
 * @property Carbon                    cancelled_at
 * @property int                       tries
 * @property float                     amount
 * @property-read Carbon              valid_until
 * @property-read User                 user
 * @property-read Coupon               coupon
 * @property-read Collection|Payment[] payments
 * @method-static Builder|Subscription active()
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $valid_until
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $cancelled_at
 * @property int $tries
 * @property string|null $token
 * @property float $amount
 * @property int|null $coupon_id
 * @property-read \App\Coupon|null $coupon
 * @property-read mixed $final_total
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereTries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereValidUntil($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_CANCELLED = 'Cancelled';

    protected $guarded = [];

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('created_at');
    }

    /**
     * Czy dana subskrypcja jest aktywna
     * @return boolean [description]
     */
    public function isValid()
    {
        return $this->valid_until->isFuture();
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function cancel()
    {
        app(SubscriptionRepository::class)->cancel($this);

        return $this;
    }

    public function scopeActive($query)
    {
        $query->where('is_active', '=', true);
    }

    public function cancelLink()
    {
        return url('/admin/subscriptions/' . $this->id . '/cancel');
    }

    public function getFinalTotalAttribute()
    {
        if ($this->coupon === null) {
            return $this->amount;
        }
    }
}
