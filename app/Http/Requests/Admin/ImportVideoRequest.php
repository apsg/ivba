<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportVideoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'url'  => 'required|url',
        ];
    }

    public function hash()
    {
        return str_replace('https://vimeo.com/', '', $this->input('url'));
    }
}
