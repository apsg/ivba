<?php
namespace App\Payments\Requests;

use App\Order;
use Illuminate\Foundation\Http\FormRequest;

class TpayIpnRequest extends FormRequest
{
    public function rules()
    {
        return [
//            "tr_id"     => 'required|string',
//            "tr_date"   => 'required|date',
//            "tr_crc"    => 'required|string',
//            "tr_amount" => 'numeric',
//            "tr_paid"   => 'numeric',
//            "tr_status" => 'required',
//            "tr_error"  => 'required|string',
//            "tr_email"  => 'email',
//            "test_mode" => 'numeric',
//            "md5sum"    => 'required|string',
        ];
    }

    public function isSuccess()
    {
        return $this->input('tr_status') === 'TRUE' && $this->input('tr_error') === 'none';
    }

    public function error()
    {
        if ($this->input('tr_error') === 'none') {
            return null;
        }

        return $this->input('tr_error');
    }

    /**
     * @return Order|null
     */
    public function order()
    {
        if (! $this->isSuccess()) {
            return null;
        }

        $decryptedOrderId = explode('|', $this->input('tr_crc'))[0] ?? null;

        return Order::findOrFail($decryptedOrderId);
    }

    public function externalId()
    {
        return $this->input('tr_id');
    }
}
