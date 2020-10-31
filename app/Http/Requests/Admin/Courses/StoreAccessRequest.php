<?php
namespace App\Http\Requests\Admin\Courses;

use App\Course;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccessRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id'   => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id',
        ];
    }

    public function selectedUser() : User
    {
        return User::find($this->input('user_id'));
    }

    public function course() : Course
    {
        return Course::find($this->input('course_id'));
    }
}