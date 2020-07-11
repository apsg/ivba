<?php
namespace App\Repositories;

use App\Answer;
use App\Question;
use App\User;

class AnswerRepository
{
    public function checkUser(User $user, Question $question, $answerData) : Answer
    {
        $correct = $question->check($answerData);

        $answer = Answer::firstOrCreate([
            'user_id'     => $user->id,
            'question_id' => $question->id,
        ]);

        $answer->update([
            'answer'     => $answerData,
            'is_correct' => $correct,
            'points'     => $correct ? $question->points : 0,
        ]);

        return $answer;
    }
}
