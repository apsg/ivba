<?php
namespace App\Domains\Forms\Requests;

use App\Helpers\GateHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFormAnswerRequest extends FormRequest
{
    const RULES = [
        'text'   => 'required|string',
        'number' => 'required|numeric|min:0',
        'url'    => 'required|string|url',
    ];

    public function authorize() : bool
    {
        return Gate::allows(GateHelper::ACCESS_COURSE, $this->route('course'));
    }

    public function rules() : array
    {
        return collect($this->route('form')->fields)
            ->map(function (array $field) {
                return static::RULES[$field['type']];
            })
            ->toArray();
    }
}
