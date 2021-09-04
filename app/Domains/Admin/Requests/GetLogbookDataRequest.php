<?php
namespace App\Domains\Admin\Requests;

use App\Course;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class GetLogbookDataRequest extends FormRequest
{
    /** @var Course */
    protected $course;

    /** @var User */
    protected $student;

    public function rules() : array
    {
        return [
            'user_id'   => 'required|numeric',
            'course_id' => 'required|numeric',
        ];
    }

    public function course() : Course
    {
        if ($this->course === null) {
            $this->course = Course::findOrFail($this->input('course_id'));
        }

        return $this->course;
    }

    public function student() : User
    {
        if ($this->student === null) {
            $this->student = User::findOrFail($this->input('user_id'));
        }

        return $this->student;
    }
}
