<?php
namespace App\Domains\Learn\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'message' => 'required|string',
            'course'  => 'sometimes|integer',
            'lesson'  => 'sometimes|integer',
        ];
    }
}
