<?php
namespace App\Domains\Courses\Repositories;

use App\Course;
use App\Question;
use App\QuestionOption;
use App\Quiz;

class QuizDuplicator
{
    /** @var Quiz */
    protected $originalQuiz;

    /** @var Quiz */
    protected $duplicatedQuiz;

    /** @var Course */
    protected $course;

    public function __construct(Quiz $quiz, Course $course)
    {
        $this->originalQuiz = $quiz;
        $this->course = $course;
    }

    public function duplicate() : self
    {
        $attributes = $this->originalQuiz->getAttributes();
        $attributes['course_id'] = $this->course->id;

        $this->duplicatedQuiz = Quiz::create($attributes);
        $this->duplicateQuestions();

        return $this;
    }

    protected function duplicateQuestions()
    {
        foreach ($this->originalQuiz->questions as $question) {
            $attributes = $question->getAttributes();
            $attributes['quiz_id'] = $this->duplicatedQuiz->id;
            $newQuestion = Question::create($attributes);

            foreach ($question->options as $option) {
                $optionAttributes = $option->getAttributes();
                $optionAttributes['question_id'] = $newQuestion->id;
                QuestionOption::create($optionAttributes);
            }
        }
    }
}
