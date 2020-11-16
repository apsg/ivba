<?php
namespace Tests\Feature\Integrations;

use App\Course;
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
    public function it_returns_all_lessons_if_no_delays_are_set()
    {
        // given
        // course

        // when
        $lessons = $this->course->visibleLessons()->get();

        // then
        $this->assertCount(3, $lessons);
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
}