<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isadmin;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'email'        => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user')->id),
            ],
            'first_name'   => 'nullable|string',
            'last_name'    => 'nullable|string',
            'address'      => 'nullable|string',
            'taxid'        => 'nullable|string',
            'company_name' => 'nullable|string',
        ];
    }
}
