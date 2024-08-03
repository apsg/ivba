<?php
namespace App\Domains\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'      => 'required|string',
            'color'     => 'string|nullable',
            'is_hidden' => 'boolean',
        ];
    }
}
