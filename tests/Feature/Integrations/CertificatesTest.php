<?php
namespace Tests\Feature\Integrations;

use App\Answer;
use App\Course;
use App\Quiz;
use App\Repositories\AnswerRepository;
use App\User;
use App\UserCertificate;
use Carbon\Carbon;
use Tests\Concerns\CourseConcerns;
use Tests\Concerns\QuizConcerns;
use Tests\TestCase;

class CertificatesTest extends TestCase
{
    use CourseConcerns;
    use QuizConcerns;

    /**
     * @var Course
     */
    protected $course;

    /**
     * @var Quiz
     */
    protected $quiz;
    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->course = $this->createCourse(1);
        $this->attachCertificate($this->course);
        $this->quiz = $this->createQuiz($this->course);
        $this->user = $this->createUser([
            'full_access_expires' => Carbon::now()->addDays(3),
        ]);
        $this->actingAs($this->user);
//        $this->assertTrue($this->user->can('access', $this->course));
//        $this->assertEquals(Auth::user()->id, $this->user->id);
    }

    /** @test */
    public function it_should_not_generate_certificate_until_the_test_is_passed()
    {
        // given
        $lesson = $this->course->lessons[0];

        // when
        $lesson->finish($this->course->id);

        // then
        $this->assertTrue($this->user->hasFinishedLesson($lesson->id));
        $this->assertFalse($this->user->hasFinishedQuiz($this->quiz->id));
        $this->assertFalse($this->user->hasFinishedCourse($this->course->id));
        $this->assertFalse(
            UserCertificate::where('user_id', $this->user->id)
                ->where('course_id', $this->course->id)
                ->exists()
        );
    }

    /** @test */
    public function it_should_not_generate_certificate_if_user_fails_the_test()
    {
        // given
        $lesson = $this->course->lessons[0];
        $lesson->finish($this->course->id);

        // when
        foreach ($this->quiz->questions as $question) {
            app(AnswerRepository::class)
                ->checkUser($this->user, $question, 'incorrect');
        }
        $this->quiz->finish();

        // then
        $this->assertTrue($this->user->hasFinishedLesson($lesson->id));
        $this->assertTrue($this->user->hasFinishedQuiz($this->quiz->id));
        $this->assertFalse($this->user->hasPassedQuiz($this->quiz->id));
        $this->assertFalse($this->user->hasFinishedCourse($this->course->id));
        $this->assertFalse(
            UserCertificate::where('user_id', $this->user->id)
                ->where('course_id', $this->course->id)
                ->exists()
        );
    }

    /** @test */
    public function it_should_generate_certificate_if_user_finishes_the_test()
    {
        // given
        $user = $this->createUser([
            'full_access_expires' => Carbon::now()->addDays(3),
        ]);
        $this->actingAs($user);
        $lesson = $this->course->lessons[0];
        $lesson->finish($this->course->id);

        // when
        foreach ($this->quiz->questions as $question) {
            app(AnswerRepository::class)
                ->checkUser($user, $question, 'correct');
        }
        foreach (Answer::where('user_id', $user->id)->get() as $answer) {
            $answer->update([
                'is_correct' => true,
                'points'     => $answer->question->points,
            ]);
        }

        $this->quiz->finish();
        $this->course->finish();

        // then
        $this->assertTrue($user->hasFinishedLesson($lesson->id));
        $this->assertTrue($user->hasFinishedQuiz($this->quiz->id));
        $this->assertTrue($user->hasPassedQuiz($this->quiz->id));
        $this->assertTrue(
            UserCertificate::where('user_id', $user->id)
                ->where('course_id', $this->course->id)
                ->exists()
        );
    }
}
