<?php
namespace App\Http\Requests\Admin\Courses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDelayRequest extends FormRequest
{
    public function rules()
    {
        return [
            'lesson_id' => 'required|numeric',
            'delay'     => 'required|numeric|min:0',
        ];
    }
}