<?php
namespace Tests\Feature\Integrations;

use App\Course;
use App\Domains\Courses\Services\CoursesService;
use Carbon\Carbon;
use Tests\Concerns\CourseConcerns;
use Tests\TestCase;

class SpecialCoursesDelayTest extends TestCase
{
    use CourseConcerns;

    /**
     * @var Course
     */
    private $course;

    protected function setUp()
    {
        parent::setUp();

        $this->course = $this->createCourse(3);
        $this->course->update([
            'is_special_access' => true,
            'scheduled_at'      => Carbon::now(),
        ]);
    }

    /** @test */
    public function it_returns_no_lessons_if_delays_are_set()
    {
        // given
        $this->course->lessons[0]->pivot->delay = 1;
        $this->course->lessons[0]->pivot->save();

        $this->course->lessons[1]->pivot->delay = 2;
        $this->course->lessons[1]->pivot->save();

        $this->course->lessons[2]->pivot->delay = 3;
        $this->course->lessons[2]->pivot->save();

        // when
        $lessons = $this->course->visibleLessons()->get();

        // then
        $this->assertCount(0, $lessons);
    }

    /** @test */
    public function it_returns_lessons_visible_at_given_time()
    {
        // given
        $this->course->lessons[0]->pivot->delay = 1;
        $this->course->lessons[0]->pivot->save();

        $this->course->lessons[1]->pivot->delay = 2;
        $this->course->lessons[1]->pivot->save();

        $this->course->lessons[2]->pivot->delay = 3;
        $this->course->lessons[2]->pivot->save();

        // when
        Carbon::setTestNow(Carbon::now()->addHours(2)->addSecond(1));
        $lessons = $this->course->visibleLessons()->get();

        // then
        $this->assertCount(2, $lessons);
    }

    /** @test */
    public function systematic_course_is_relative_to_when_user_started_it()
    {
        // given
        $course = $this->createCourse(3);
        $course->update([
            'is_systematic' => true,
        ]);
        $course->lessons[0]->pivot->delay = 1;
        $course->lessons[0]->pivot->save();
        $course->lessons[1]->pivot->delay = 2;
        $course->lessons[1]->pivot->save();
        $course->lessons[2]->pivot->delay = 3;
        $course->lessons[2]->pivot->save();
        $user = $this->createUser();
        $user->courses()->attach($course->id);

        // when
        $lessons = $course->visibleLessons($user)->get();

        // then
        $this->assertCount(0, $lessons);

        // when
        Carbon::setTestNow(Carbon::now()->addHours(2));
        $lessons = $course->visibleLessons($user)->get();

        // then
        $this->assertCount(2, $lessons);

        // when
        Carbon::setTestNow(Carbon::now()->addHours(4));
        $lessons = $course->visibleLessons($user)->get();

        // then
        $this->assertCount(3, $lessons);
    }
}
