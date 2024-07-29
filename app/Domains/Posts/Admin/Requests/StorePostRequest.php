<?php
namespace App\Domains\Posts\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'   => 'required|string',
            'body'    => 'required|string',
            'cta_url' => 'sometimes|string|url',
        ];
    }
}
