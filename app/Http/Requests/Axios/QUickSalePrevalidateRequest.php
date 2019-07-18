<?php
namespace App\Http\Requests\Axios;

use Illuminate\Foundation\Http\FormRequest;

class QUickSalePrevalidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/\d{9}/i',
            'name'  => 'required|string',
        ];
    }
}
