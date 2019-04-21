<?php
namespace Tests\Feature\Integrations;

use App\Course;
use App\Quiz;
use App\Repositories\AnswerRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Concerns\CourseConcerns;
use Tests\Concerns\QuizConcerns;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use DatabaseTransactions;

    use QuizConcerns;
    use CourseConcerns;

    /** @var Course */
    public $course;

    /** @var Quiz */
    public $quiz;

    /** @var User */
    public $user;

    public $app;

    protected function setUp()
    {
        parent::setUp();

        $this->app = $this->createApplication();

        $this->user = $this->createUser();
        $this->user->update([
            'full_access_expires' => Carbon::now()->addMonth(),
        ]);
        $this->course = $this->creteCourse();
        $this->quiz = $this->createQuiz($this->course);

        $this->actingAs($this->user);
        $this->app->boot();
    }

    /** @test */
    public function it_creates_working_quiz_with_questions()
    {
        // given
        // Setup

        // when

        // then
        $this->assertTrue($this->quiz instanceof Quiz);
        $this->assertTrue($this->quiz->questions->count() > 0);
        $this->assertEquals(3, $this->quiz->questions->count());
    }

    /** @test */
    public function user_can_access_the_quiz_for_the_first_time()
    {
        // given

        // when

        // then
        $this->assertTrue($this->user->can('access', $this->course));
        $this->assertTrue($this->user->can('retake-quiz', $this->quiz));
    }

    /** @test */
    public function user_with_no_access_to_course_cannot_take_quiz()
    {
        // given
        $user = $this->createUser([
            'full_access_expires' => null,
        ]);

        // when
        $this->assertFalse($user->can('access', $this->quiz->course));

        // then
        $this->assertFalse($user->can('retake-quiz', $this->quiz));
    }

    /** @test */
    public function when_user_fails_on_test_cannot_access_quiz_again_for_days()
    {
        Carbon::setTestNow(Carbon::now()->subMonth());

        // given
        foreach ($this->quiz->questions as $question) {
            app(AnswerRepository::class)
                ->checkUser($this->user, $question, 'incorrect');
        }

        // when
        $this->quiz->finish();

        // then
        $this->assertTrue($this->user->can('access', $this->quiz->course));
        $this->assertFalse($this->user->can('retake-quiz', $this->quiz));

        // when
        Carbon::setTestNow(Carbon::now()->addMonth());
        $quiz = $this->user->quizzes()
            ->withPivot('finished_date')
            ->where('quiz_id', $this->quiz->id)
            ->first();

        // then
        $this->assertTrue(Carbon::parse($quiz->pivot->finished_date)->diffInDays() > 14);
        $this->assertTrue($this->user->can('retake-quiz', $quiz));
    }
}