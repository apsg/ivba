<?php

namespace App\Domains\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetSettingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'key'   => 'required|string',
            'value' => 'sometimes',
        ];
    }
}
