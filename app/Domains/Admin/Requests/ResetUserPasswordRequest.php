<?php

namespace App\Domains\Admin\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResetUserPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->can('admin');
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:users,id'],
        ];
    }

    public function getUser(): User
    {
        return User::find($this->input('id'));
    }
}
