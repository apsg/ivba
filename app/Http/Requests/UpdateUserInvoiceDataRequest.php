<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInvoiceDataRequest extends FormRequest
{
    public function rules()
    {
        return [
            'company_name' => 'required',
            'address'      => 'required',
            'taxid'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'company_name' => 'Podaj nazwę firmy',
            'address'      => 'Podaj pełen adres firmy z kodem pocztowym',
            'taxid'        => 'Podaj poprawny numer NIP',
        ];
    }
}
