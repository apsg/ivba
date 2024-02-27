<?php
namespace App;

use App\Fakturownia\OrderInvoice;
use App\Fakturownia\PaymentInvoice;
use App\Interfaces\InvoicableContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class App\InvoiceRequest.
 *
 * @property int id
 * @property int invoicable_id
 * @property string invoicable_type
 * @property string|null custom_description
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon|null refused_at
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
            $invoice = new OrderInvoice($this->invoicable, $this->custom_description);
        }

        if ($this->invoicable instanceof Payment) {
            $invoice = new PaymentInvoice($this->invoicable, $this->custom_description);
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

    public function reject(): self
    {
        $this->update([
                          'refused_at' => Carbon::now(),
                      ]);

        return $this;
    }

    public function getDescription(): ?string
    {
        if ($this->invoicable instanceof Order) {
            return $this->invoicable->description;
        }

        if ($this->invoicable instanceof Payment) {
            return $this->invoicable->title;
        }

        return '';
    }

    public function getTotal(): string
    {
        if ($this->invoicable instanceof Order) {
            return $this->invoicable->total();
        }

        if ($this->invoicable instanceof Payment) {
            return $this->invoicable->amount;
        }

        return '';
    }

    public function user(): ?User
    {
        if ($this->invoicable instanceof Order) {
            return $this->invoicable->user;
        }

        if ($this->invoicable instanceof Payment) {
            return $this->invoicable->subscription->user;
        }

        return null;
    }

    public function getProducts(): array
    {
        if ($this->invoicable instanceof Order) {
            if ($this->invoicable->is_easy_access) {
                return ['Szybki dostęp'];
            }

            if ($this->invoicable->is_full_access) {
                return ['Pełen dostęp do strony'];
            }

            return $this->invoicable->quick_sales->map(function (QuickSale $quickSale) {
                return $quickSale->name . ' (Szybka sprzedaż)';
            })->toArray();
        }

        if ($this->invoicable instanceof Payment) {
            return ['Płatność w subskrypcji'];
        }

        return [];
    }

    public function getIdentifier(): string
    {
        if ($this->invoicable_type === Order::class) {
            return "Zamówienie #{$this->invoicable_id}";
        }

        if ($this->invoicable_type === Payment::class) {
            return "Płatność subskrypcyjna #{$this->invoicable_id}";
        }

        return "";
    }
}
