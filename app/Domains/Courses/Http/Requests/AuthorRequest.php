<?php
namespace App\Domains\Courses\Http\Requests;

use App\Helpers\GateHelper;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(GateHelper::ADMIN);
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string',
            'image'       => 'required|url',
            'description' => 'required|string',
            'bio'         => 'nullable|string',
            'is_internal' => 'boolean',
        ];
    }
}
