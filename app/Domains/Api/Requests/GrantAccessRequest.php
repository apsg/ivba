<?php
namespace App\Domains\Api\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class GrantAccessRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'email'     => 'required|email',
            'course_id' => 'required|integer|exists:courses,id',
        ];
    }

    public function course() : Course
    {
        return Course::find($this->input('course_id'));
    }
}
