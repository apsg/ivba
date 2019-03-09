<?php

namespace Tests\Feature;

use App\Lesson;
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

    public function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->user = User::create([
            'name'  => $this->faker->name,
            'email' => $this->faker->email,
        ]);

        factory(Lesson::class, 10)->create();

    }

    /** @test */
    public function it_counts_users_finished_lessons()
    {


    }
}
