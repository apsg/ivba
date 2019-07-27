<?php

namespace App;

use App\Fakturownia\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceRequest
 * @package App
 *
 * @property int         id
 * @property int         order_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property Carbon|null refused_at
 *
 * @property-read Order  order
 */
class InvoiceRequest extends Model
{
    protected $guarded = [];

    protected $dates = [
        'refused_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function confirm()
    {
        $invoiceId = (new Invoice($this->order))->generate();

        if ($invoiceId !== null) {
            $this->delete();
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
}
