<?php
namespace Tests\Feature\Integrations;

use App\Access;
use App\Course;
use App\Repositories\AccessRepository;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Concerns\CourseConcerns;
use Tests\Concerns\UserConcerns;
use Tests\TestCase;

class AccessesTest extends TestCase
{
    use CourseConcerns;
    use UserConcerns;
    use InteractsWithDatabase;
    use DatabaseTransactions;

    /** @var User */
    protected $user;

    /** @var Course */
    protected $course;

    /**@var AccessRepository */
    protected $repository;

    protected function setUp()
    {
        parent::setUp();

        $this->user = $this->createUser([
            'isadmin'             => false,
            'full_access_expires' => null,
        ]);
        $this->course = $this->createCourse(3);
        $this->repository = app(AccessRepository::class);
    }

    /** @test */
    public function should_not_allow_user_to_access_course()
    {
        // given
        // user and course
        $this->actingAs($this->user);

        // when
        $courseAccess = Gate::allows('access', $this->course);
        $lessonAccess = Gate::allows('access', $this->course->lessons()->first());

        // then
        $this->assertFalse($courseAccess);
        $this->assertFalse($lessonAccess);
    }

    /** @test */
    public function should_allow_user_with_custom_access_to_access_course()
    {
        // given
        $this->actingAs($this->user);
        $this->repository->grant($this->user, $this->course);

        // when
        $courseAccess = Gate::allows('access', $this->course);
        $lessonAccess = Gate::allows('access', $this->course->lessons()->first());

        // then
        $this->assertDatabaseHas('accesses', [
            'user_id'         => $this->user->id,
            'accessable_id'   => $this->course->id,
            'accessable_type' => Course::class,
        ]);
        $this->assertTrue($courseAccess);
        $this->assertTrue($lessonAccess);
    }

    /** @test */
    public function should_allow_user_with_custom_expiring_access_to_access_course()
    {
        // given
        $this->actingAs($this->user);
        $this->repository->grant($this->user, $this->course, 2);

        // when
        $courseAccess = Gate::allows('access', $this->course);
        $lessonAccess = Gate::allows('access', $this->course->lessons()->first());

        // then
        $this->assertDatabaseHas('accesses', [
            'user_id'         => $this->user->id,
            'accessable_id'   => $this->course->id,
            'accessable_type' => Course::class,
        ]);
        $this->assertTrue($courseAccess);
        $this->assertTrue($lessonAccess);
    }


    /** @test */
    public function should_not_allow_user_with_custom_expired_access_to_access_course()
    {
        // given
        $this->actingAs($this->user);
        $this->repository->grant($this->user, $this->course, 2);

        Carbon::setTestNow(Carbon::now()->addDays(3));

        // when
        $courseAccess = Gate::allows('access', $this->course);
        $lessonAccess = Gate::allows('access', $this->course->lessons()->first());

        $access = Access::forUser($this->user)
            ->forItem($this->course)
            ->first();

        // then
        $this->assertTrue($access->expires_at->isPast());
        $this->assertDatabaseHas('accesses', [
            'user_id'         => $this->user->id,
            'accessable_id'   => $this->course->id,
            'accessable_type' => Course::class,
        ]);
        $this->assertFalse($courseAccess);
        $this->assertFalse($lessonAccess);
    }
}
