<?php
namespace App\Http\Requests\Axios;

use Illuminate\Foundation\Http\FormRequest;

class QuickSaleOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
            'name'  => 'required|string',
        ];
    }
}
