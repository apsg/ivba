<?php
namespace App\Domains\Learn\Requests;

use App\Course;
use App\Lesson;
use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required|string',
            'course'  => 'sometimes|integer',
            'lesson'  => 'nullable|sometimes|integer',
            'phone'   => 'nullable|sometimes|string',
        ];
    }

    /** @return Course|null */
    public function course()
    {
        return Course::find($this->input('course'));
    }

    /** @return Lesson|null */
    public function lesson()
    {
        return Lesson::find($this->input('lesson'));
    }
}
