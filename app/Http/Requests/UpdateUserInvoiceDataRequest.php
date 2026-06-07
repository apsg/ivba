<?php
namespace App\Http\Requests;

use App\Rules\PeselRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInvoiceDataRequest extends FormRequest
{
    public function rules()
    {
        return [
            'company_name' => 'required',
            'address'      => 'required',
            'taxid'        => 'sometimes',
            'pesel'        => ['sometimes', 'nullable', new PeselRule()],
        ];
    }

    public function messages()
    {
        return [
            'company_name' => 'Podaj nazwę firmy',
            'address'      => 'Podaj pełen adres firmy z kodem pocztowym',
            'taxid'        => 'Podaj poprawny numer NIP',
            'pesel'        => 'Podaj poprawny numer PESEL',
        ];
    }
}
