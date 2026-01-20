<?php
namespace App\Domains\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
