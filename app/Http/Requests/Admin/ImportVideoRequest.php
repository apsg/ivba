<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportVideoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'          => 'required|string',
            'cloudflare_id' => 'required|string',
        ];
    }
}
