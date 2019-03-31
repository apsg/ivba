<?php
namespace Tests\Feature;

use App\Services\RankingService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RankingServiceTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @var User */
    protected $user;

    /** @var RankingService */
    protected $rankingService;

    public function setUp()
    {
        parent::setUp();

//        $this->artisan('db:seed');

        $this->user = User::create([
            'name'  => $this->faker->name,
            'email' => $this->faker->email,
        ]);

        $this->rankingService = app(RankingService::class);

    }

    /** @test */
    public function it_correctly_counts_position_for_new_users()
    {
        // given user

        // when
        $position = $this->rankingService->getUserPosition($this->user);

        // then
        $this->assertEquals(0, $position);
    }

    /** @test */
    public function it_correctly_counts_position_for_users_with_points()
    {
        // given
        $this->rankingService->grantForLesson($this->user);

        // when
        $points = $this->rankingService->getUserPoints($this->user);

        // then
        $this->assertEquals(
            config('rating.lesson'),
            $points
        );
    }
}
