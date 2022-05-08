<?php
namespace App\Domains\Forms\Requests\Forms;

use Illuminate\Foundation\Http\FormRequest;

class AnswerCommentRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'comment' => 'required|string',
        ];
    }
}
