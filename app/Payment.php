<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * @property string            subscription_id
 * @property string            title
 * @property float             amount
 * @property string            external_id
 * @property Carbon            cancelled_at
 * @property bool              is_recurrent
 * @property-read Subscription subscription
 *
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
        'confirmed_at' => 'date',
        'cancelled_at' => 'date',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function isFirstPayment() : bool
    {
        return !$this->is_recurrent;
    }

}