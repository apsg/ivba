<?php
namespace App;

use App\Fakturownia\OrderInvoice;
use App\Fakturownia\PaymentInvoice;
use App\Interfaces\InvoicableContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class App\InvoiceRequest
 * @package App
 *
 * @property int                     id
 * @property int                     invoicable_id
 * @property string                  invoicable_type
 * @property Carbon                  created_at
 * @property Carbon                  updated_at
 * @property Carbon|null             refused_at
 *
 * @property-read InvoicableContract invoicable
 */
class InvoiceRequest extends Model
{
    protected $guarded = [];

    protected $dates = [
        'refused_at',
    ];

    public function invoicable()
    {
        return $this->morphTo('invoicable');
    }

    public function confirm()
    {
        $invoice = null;

        if ($this->invoicable instanceof Order) {
            $invoice = new OrderInvoice($this->invoicable);
        }

        if ($this->invoicable instanceof Payment) {
            $invoice = new PaymentInvoice($this->invoicable);
        }

        if ($invoice === null) {
            return null;
        }

        $invoiceId = $invoice->generate();

        if ($invoiceId !== null) {
            $this->delete();
            $invoice->sendEmail();
        }

        return $invoiceId;
    }

    public function reject() : self
    {
        $this->update([
            'refused_at' => Carbon::now(),
        ]);

        return $this;
    }

    public function getDescription() : string
    {
        if ($this->invoicable instanceof Order) {
            return $this->invoicable->description;
        }

        if ($this->invoicable instanceof Payment) {
            return $this->invoicable->title;
        }

        return '';
    }

    public function getTotal() : string
    {
        if ($this->invoicable instanceof Order) {
            return $this->invoicable->total();
        }

        if ($this->invoicable instanceof Payment) {
            return $this->invoicable->amount;
        }

        return '';
    }
}
