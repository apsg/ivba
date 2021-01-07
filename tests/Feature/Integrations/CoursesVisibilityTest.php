<?php
namespace Tests\Feature\Integrations;

use App\Repositories\AccessRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Concerns\CourseConcerns;
use Tests\Concerns\QuizConcerns;
use Tests\TestCase;

class CoursesVisibilityTest extends TestCase
{
    use CourseConcerns;
    use QuizConcerns;
    use DatabaseTransactions;

    /** @var array */
    protected $courses;

    protected function setUp()
    {
        parent::setUp();

        $this->courses[] = $this->createCourse(1);
        $this->courses[] = $this->createCourse(1);
    }

    /** @test */
    public function courses_were_created_correctly()
    {
        // given
        $user = $this->createUser();
        $user->courses()->attach($this->courses[0]->id);

        // when
        $response = $this
            ->actingAs($user)
            ->get('/a/courses');

        // then
        $response->assertSee($this->courses[0]->title);
        $response->assertSee($this->courses[1]->title);

        // when
        $response = $this
            ->actingAs($user)
            ->get('/account');

        // then
        $response->assertSee($this->courses[0]->title);
        $response->assertDontSee($this->courses[1]->title);
    }

    /** @test */
    public function special_access_course_is_not_visible_to_oridinary_user()
    {
        // given
        $specialCourse = $this->createSpecialCourse(1);
        $user = $this->createUser();

        // when
        $response = $this
            ->actingAs($user)
            ->get('/a/courses');

        // then
        $response->assertDontSee($specialCourse->title);
    }

    /** @test */
    public function special_access_course_is_visible_to_user_that_has_access()
    {
        // given
        $specialCourse = $this->createSpecialCourse(1);
        $user = $this->createUser();

        // when
        $accessRepository = app(AccessRepository::class);
        $accessRepository->grant($user, $specialCourse);
        $responseCourseList = $this
            ->actingAs($user)
            ->get('/a/courses');
        $responseAccount = $this
            ->actingAs($user)
            ->get('/account');
        $accesses = $accessRepository->getCourseAccessIdsForUser($user);

        // then
        $this->assertArraySubset([$specialCourse->id], $accesses);
        $responseCourseList->assertSee($specialCourse->title);
        $responseAccount->assertSee($specialCourse->title);
    }
}