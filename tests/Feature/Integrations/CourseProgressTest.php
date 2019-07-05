<?php
namespace Tests\Feature\Integrations;

use App\Course;
use App\Lesson;
use App\Quiz;
use App\Services\CourseProgressService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Concerns\CourseConcerns;
use Tests\Concerns\QuizConcerns;
use Tests\TestCase;

class CourseProgressTest extends TestCase
{
    use CourseConcerns;
    use QuizConcerns;
    use DatabaseTransactions;

    /** @var User */
    protected $user;

    /** @var Course */
    protected $course;

    /** @var Quiz */
    protected $quiz;

    /** @var CourseProgressService */
    protected $service;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->course = $this->createCourse(5);
        $this->quiz = $this->createQuiz($this->course);
        $this->service = app(CourseProgressService::class);
    }

    /** @test */
    public function it_created_valid_course_with_lessons()
    {
        // given course

        // when
        $count = $this->course->lessons()->count();

        // then
        $this->assertEquals(5, $count);
        $this->assertEquals(1, $this->course->quizzes()->count());
    }

    /** @test */
    public function it_returns_0_if_user_has_not_finished_any_lesson_yet()
    {
        // given course and user
        $this->actingAs($this->user);

        // when
        $total = $this->service->total($this->course);
        $finished = $this->service->finished($this->user, $this->course);
        $progress = $this->service->progress($this->user, $this->course);

        // then
        $this->assertEquals(6, $total);
        $this->assertEquals(0, $finished);
        $this->assertEquals(0, $progress);
    }

    /** @test */
    public function it_returns_count_if_user_has_finished_lesson()
    {
        // given course and user
        $this->actingAs($this->user);

        /** @var Lesson $lesson */
        $lesson = $this->course->lessons->first();
        $lesson->finish($this->course->id);

        // when
        $finished = $this->service->finished($this->user, $this->course);
        $progress = $this->service->progress($this->user, $this->course);

        // then
        $this->assertEquals(1, $finished);
        $this->assertEquals(1 / 6, $progress);
    }

    /** @test */
    public function it_returns_count_if_user_has_finished_all_lessons_but_not_quiz()
    {
        // given course and user
        $this->actingAs($this->user);

        foreach ($this->course->lessons as $lesson) {
            $lesson->finish($this->course->id);
        }

        // when
        $finished = $this->service->finished($this->user, $this->course);
        $progress = $this->service->progress($this->user, $this->course);

        // then
        $this->assertEquals(5, $finished);
        $this->assertEquals(5 / 6, $progress);
    }

    /** @test */
    public function it_returns_1_if_all_lessons_and_quizzes_are_finished()
    {
        // given course and user
        $this->actingAs($this->user);

        foreach ($this->course->lessons as $lesson) {
            $lesson->finish($this->course->id);
        }

        $this->quiz->finish();

        // when
        $finished = $this->service->finished($this->user, $this->course);
        $progress = $this->service->progress($this->user, $this->course);

        // then
        $this->assertEquals(6, $finished);
        $this->assertEquals(1, $progress);
    }

    /** @test */
    public function there_is_an_endpoint_that_returns_progress_for_a_course()
    {
        // given
        $this->actingAs($this->user);
        $url = url('/learn/course/' . $this->course->slug . '/progress');
        $finished = $this->service->finished($this->user, $this->course);
        $progress = $this->service->progress($this->user, $this->course);
        $total = $this->service->total($this->course);

        // when
        $response = $this->get($url);

        // then
        $response->assertStatus(200);
        $response->assertJson(compact('finished', 'progress', 'total'));
    }

    /** @test */
    public function endpoint_fails_if_user_is_not_logged_in()
    {
        // given
        $url = url('/learn/course/' . $this->course->slug . '/progress');
        $this->flushSession();

        // when
        $response = $this->json('GET', $url);

        // then
        $response->assertStatus(401);
    }
}
