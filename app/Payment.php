<?php
namespace App;

use App\Payments\Tpay\TpayHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @property string            subscription_id
 * @property string            title
 * @property float             amount
 * @property string            external_id
 * @property Carbon            cancelled_at
 * @property Carbon            confirmed_at
 * @property bool              is_recurrent
 * @property string|null       cancel_reason
 * @property-read Subscription subscription
 * @property-read string       reason
 * @method Builder|Payment forUser(User $user)
 * @method Builder|Payment confirmed()
 * @property int $id
 * @property int $subscription_id
 * @property string $title
 * @property float $amount
 * @property string|null $external_id
 * @property \Illuminate\Support\Carbon|null $confirmed_at
 * @property \Illuminate\Support\Carbon|null $cancelled_at
 * @property string|null $cancel_reason
 * @property int $is_recurrent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $reason
 * @property-read \App\Subscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereIsRecurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    protected $fillable = [
        'subscription_id',
        'title',
        'amount',
        'external_id',
        'cancelled_at',
        'is_recurrent',
        'confirmed_at',
        'cancel_reason',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function isFirstPayment() : bool
    {
        return !$this->is_recurrent;
    }

    public function scopeForUser($query, User $user)
    {
        $query->whereIn('subscription_id', $user->subscriptions->pluck('id'));
    }

    public function scopeConfirmed($query)
    {
        $query->whereNotNull('confirmed_at');
    }

    public function getReasonAttribute()
    {
        return TpayHelper::translateReason($this->cancel_reason);
    }
}
