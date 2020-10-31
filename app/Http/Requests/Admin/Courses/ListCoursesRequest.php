<?php
namespace App\Http\Requests\Admin\Courses;

use Illuminate\Foundation\Http\FormRequest;

class ListCoursesRequest extends FormRequest
{
    public function rules()
    {
        return [
            's' => 'string|nullable',
        ];
    }
}