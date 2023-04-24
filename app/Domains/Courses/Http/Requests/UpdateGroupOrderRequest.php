<?php
namespace App\Domains\Courses\Http\Requests;

use App\Domains\Courses\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group' => 'required|integer|exists:groups,id',
            'order' => 'required|array',
        ];
    }

    public function group(): Group
    {
        return Group::find($this->input('group'));
    }
}
