<?php
namespace App;

use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Subscription.
 *
 * @property int                       $id
 * @property Carbon|null               $created_at
 * @property Carbon|null               $updated_at
 * @property string|null               $token
 * @property int                       user_id
 * @property int                       coupon_id
 * @property string                    profileid
 * @property bool                      is_active
 * @property Carbon                    cancelled_at
 * @property int                       tries
 * @property float                     amount
 * @property string|null               stripe_plan_id
 * @property string|null               stripe_subscription_id
 *
 * @property-read Carbon               valid_until
 * @property-read User                 user
 * @property-read Coupon               coupon
 * @property-read Collection|Payment[] payments
 * @property-read mixed                $final_total
 * @method static Builder|Subscription active()
 * @method static Builder|Subscription notStripe()
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

    public function isValid(): bool
    {
        return $this->valid_until->isFuture();
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function cancel(): Subscription
    {
        app(SubscriptionRepository::class)->cancel($this);

        return $this;
    }

    public function isPending(): bool
    {
        if ($this->is_active) {
            return false;
        }

        if ($this->valid_until !== null) {
            return false;
        }

        if ($this->cancelled_at !== null) {
            return false;
        }

        return true;
    }

    public function scopeActive($query)
    {
        $query->where('is_active', '=', true);
    }

    public function scopeNotStripe(Builder $query): Builder
    {
        return $query->whereNull('stripe_plan_id');
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
