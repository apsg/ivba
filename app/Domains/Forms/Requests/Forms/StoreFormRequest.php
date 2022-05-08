<?php
namespace App\Domains\Forms\Requests\Forms;

use App\Helpers\GateHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows(GateHelper::ADMIN);
    }

    public function rules() : array
    {
        return [
            'type'      => 'required|in:' . implode(',', array_keys(config('forms'))),
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
