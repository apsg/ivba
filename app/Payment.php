<?php
namespace App;

use App\Fakturownia\PaymentInvoice;
use App\Interfaces\InvoicableContract;
use App\Payments\Tpay\TpayHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @property string              subscription_id
 * @property string              title
 * @property float               amount
 * @property string              external_id
 * @property int|null            invoice_id
 * @property Carbon              cancelled_at
 * @property Carbon              confirmed_at
 * @property bool                is_recurrent
 * @property string|null         cancel_reason
 * @property-read Subscription   subscription
 * @property-read string         reason
 * @property-read InvoiceRequest invoice_request
 * @method Builder|Payment forUser(User $user)
 * @method Builder|Payment confirmed()
 * @property int                 $id
 * @property Carbon|null         $created_at
 * @property Carbon|null         $updated_at
 * @mixin \Eloquent
 */
class Payment extends Model implements InvoicableContract
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
        'invoice_id',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function invoice_request()
    {
        return $this->morphOne(InvoiceRequest::class, 'invoicable');
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

    // --------------- InvoicableContract ----------------

    public function hasInvoice() : bool
    {
        return $this->invoice_id !== null;
    }

    public function invoiceDownloadUrl() : ?string
    {
        if ($this->hasInvoice()) {
            return (new PaymentInvoice($this))->getDownloadUrl();
        }

        return null;
    }

    public function invoiceId() : ?int
    {
        return $this->invoice_id;
    }

    public function getSellDateFormatted() : string
    {
        if ($this->confirmed_at === null) {
            return now()->format('Y-m-d');
        }

        return $this->confirmed_at->format('Y-m-d');
    }

    public function getEmail() : string
    {
        return $this->subscription->user->email ?? '';
    }

    public function getUser() : User
    {
        return $this->subscription->user;
    }

    public function isConfirmed()
    {
        if (empty($this->confirmed_at)) {
            return false;
        }

        if (!empty($this->cancelled_at)) {
            return false;
        }

        return true;
    }
}
