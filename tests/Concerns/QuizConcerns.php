<?php
namespace Tests\Concerns;

use App\Course;
use App\Question;
use App\QuestionOption;
use App\Quiz;

trait QuizConcerns
{

    public function createQuiz(Course $course) : Quiz
    {
        $quiz = factory(Quiz::class)->create([
            'course_id' => $course->id,
        ]);

        $this->attachQuestions($quiz);

        return $quiz;
    }

    protected function attachQuestions(Quiz $quiz)
    {
        $quiz->questions()->save(factory(Question::class)->create([
            'quiz_id' => $quiz->id,
        ]));

        /** @var Question $singleQuestion */
        $singleQuestion = factory(Question::class, 'single')->create([
            'quiz_id' => $quiz->id,
        ]);

        $singleQuestion->options()->save(factory(QuestionOption::class, 'correct')->make());
        $singleQuestion->options()->save(factory(QuestionOption::class, 'incorrect')->make());

        $multipleQuestion = factory(Question::class, 'multiple')->create([
            'quiz_id' => $quiz->id,
        ]);
        $multipleQuestion->options()->save(factory(QuestionOption::class, 'correct')->make());
        $multipleQuestion->options()->save(factory(QuestionOption::class, 'incorrect')->make());
        $multipleQuestion->options()->save(factory(QuestionOption::class, 'correct')->make());
        $multipleQuestion->options()->save(factory(QuestionOption::class, 'incorrect')->make());
    }
}