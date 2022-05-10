<?php
namespace App\Domains\Forms\Transformers;

use App\Domains\Forms\Models\FormAnswer;
use League\Fractal\TransformerAbstract;

class FormAnswerTransformer extends TransformerAbstract
{
    public function transform(FormAnswer $answer) : array
    {
        return [
            'id'           => $answer->id,
            'user'         => $answer->user->name . ' (' . $answer->user->email . ')',
            'answer'       => $answer->formatAnswersAsParagraph(true)->render(),
            'commenter'    => $answer->commenter ? ($answer->commenter->name . ' (' . $answer->commenter->email . ')') : '',
            'commented_at' => $answer->commented_at ? $answer->commented_at->format('Y-m-d H:i') : null,
            'comment'      => $answer->comment,
            'created_at'   => $answer->created_at->format('Y-m-d H:i'),
        ];
    }
}
