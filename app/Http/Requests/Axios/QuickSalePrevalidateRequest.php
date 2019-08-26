<?php
namespace App\Http\Requests\Axios;

use Illuminate\Foundation\Http\FormRequest;

class QuickSalePrevalidateRequest extends FormRequest
{
    public function rules()
    {
        $additional = [];

        if ($this->input('is_full_data_required')) {
            $additional = [
                'street'   => 'required|string',
                'postcode' => 'required|regex:/\d{2}-\d{3}/i',
                'city'     => 'required|string',
            ];
        }

        return [
                'email' => 'required|email',
                'phone' => 'required|numeric|regex:/\d{9}/i',
                'name'  => 'required|string',
            ] + $additional;
    }

    public function messages()
    {
        return [
            'street.required' => 'Niepoprawna ulica',
            'postcode.regex'  => 'Niepoprawny kod pocztowy',
            'city.required'   => 'Niepoprawne miasto',
        ];
    }
}
