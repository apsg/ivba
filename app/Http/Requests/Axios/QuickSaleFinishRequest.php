<?php
namespace App\Http\Requests\Axios;

use Illuminate\Foundation\Http\FormRequest;

class QuickSaleFinishRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'order' => 'required|numeric|exists:orders,id',
            'group' => 'required|numeric',
        ];
    }
}
