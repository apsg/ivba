<?php
namespace App;

use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Subscription
 *
 * @property int                             user_id
 * @property int                             coupon_id
 * @property string                          profileid
 * @property bool                            is_active
 * @property Carbon                          cancelled_at
 * @property int                             tries
 * @property float                           amount
 * @property-read Carbon                     valid_until
 * @property-read User                       user
 * @property-read Coupon                     coupon
 * @property-read Collection|Payment[]       payments
 * @method-static Builder|Subscription active()
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $token
 * @property-read mixed                      $final_total
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
