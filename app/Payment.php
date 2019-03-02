<?php
namespace App;

use App\Payments\Tpay\TpayHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
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
