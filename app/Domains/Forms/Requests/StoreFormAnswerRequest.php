<?php
namespace App\Domains\Forms\Requests;

use App\Domains\Forms\Models\Form;
use App\Helpers\GateHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFormAnswerRequest extends FormRequest
{
    const RULES = [
        Form::FIELD_TEXT   => 'required|string',
        Form::FIELD_NUMBER => 'required|numeric|min:0',
        Form::FIELD_URL    => 'required|string|url',
        Form::FIELD_WEEK   => 'required|numeric|min:1|max:54',
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
                ->toArray()
            + collect($this->route('form')->fields)
                ->filter(function (array $field) {
                    return $field['type'] === Form::FIELD_WEEK;
                })
                ->mapWithKeys(function ($item, $key) {
                    return [
                        $key . 'year' => 'required|numeric|min:2022',
                    ];
                })->toArray();
    }
}
