<?php
namespace Tests\Feature\Integrations;

use App\Lesson;
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
        parent::setUp();

//        $this->artisan('db:seed');

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
        $afterPoints = $this->user->total_points;

        // then
        $this->assertEquals($initialPoints + config('rating.lesson'), $afterPoints);
    }
}
