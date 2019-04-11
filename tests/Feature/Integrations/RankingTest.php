<?php
namespace Tests\Feature\Integrations;

use App\Course;
use App\Lesson;
use App\Quiz;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RankingTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @var User */
    protected $user;

    public function setUp()
    {
        putenv('CACHE_DRIVER=array');

        parent::setUp();

        $this->user = User::create([
            'name'  => $this->faker->name,
            'email' => $this->faker->email,
        ]);

        $this->actingAs($this->user);
    }

    /** @test */
    public function it_returns_users_points()
    {
        // given user

        // when
        $points = $this->user->total_points;

        // then
        $this->assertGreaterThan(-1, $points);
    }

    /** @test */
    public function it_adds_points_when_user_finishes_lesson()
    {
        // given
        /** @var Lesson $lesson */
        $lesson = factory(Lesson::class)->create();
        $initialPoints = $this->user->total_points;

        // when
        $lesson->finish();
        $lesson->finish(); // Double finishing the lesson should grant the points only once
        $afterPoints = $this->user->total_points;

        // then
        $this->assertEquals($initialPoints + config('rating.lesson'), $afterPoints);
    }

    /** @test */
    public function it_adds_points_when_user_passes_quiz()
    {
        // given
        $course = factory(Course::class)->create();
        /** @var Quiz $quiz */
        $quiz = factory(Quiz::class)->create([
            'course_id'      => $course->id,
            'pass_threshold' => 0,
        ]);
        $initialPoints = $this->user->total_points;

        // when
        $quiz->finish();
        $quiz->finish(); // Double passing the quiz should grant the points only once
        $afterPoints = $this->user->total_points;

        // then
        $this->assertEquals($initialPoints + config('rating.quiz'), $afterPoints);
    }

}
