<?php
namespace Tests\Feature\Integrations\Coupons;

use App\Coupon;
use App\Domains\Payments\Repositories\CouponRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tests\Concerns\CourseConcerns;
use Tests\TestCase;

class CouponGenerationTest extends TestCase
{
    use CourseConcerns;

    /**
     * @var CouponRepository
     */
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->app->make(CouponRepository::class);
    }

    /** @test */
    public function it_creates_coupons()
    {
        // given
        $count = 10;
        $type = Coupon::TYPE_SUBSCRIPTION_PERCENT;
        $amount = 50;

        // when
        $coupons = $this->repository->generate(
            $type,
            $count,
            $amount
        );

        // then
        $this->assertCount($count, $coupons);
        /** @var Coupon $coupon */
        $coupon = $coupons->random();

        $this->assertNotNull($coupon->code);
        $this->assertEquals($type, $coupon->type);
        $this->assertEquals($amount, $coupon->amount);
    }

    /** @test */
    public function it_attaches_course_correctly_to_coupon()
    {
        // given
        $course = $this->createCourse();

        // when
        /** @var Coupon $coupon */
        $coupon = $this->repository->generate(
            Coupon::TYPE_COURSE_ACCESS,
            1,
            100,
            1,
            [$course->id]
        )[0];

        // then
        $this->assertNotNull($coupon->courses);
        $this->assertCount(1, $coupon->courses);
        $this->assertEquals($course->id, $coupon->courses[0]->id);
    }

    /** @test */
    public function it_grants_access_to_courses_attached_to_coupon()
    {
        // given
        $user = $this->createUserNoAccess();
        Auth::login($user);

        $course1 = $this->createCourse(1);
        $course2 = $this->createCourse(1);

        $this->assertFalse(Gate::allows('access-course', $course1));
        $this->assertFalse(Gate::allows('access-course', $course2));

        /** @var Coupon $coupon */
        $coupon = $this->repository->generate(
            Coupon::TYPE_COURSE_ACCESS,
            1,
            0,
            1,
            [$course1->id, $course2->id]
        )[0];

        // when
        $coupon->use();

        // then
        $this->assertTrue(Gate::allows('access-course', $course1));
        $this->assertTrue(Gate::allows('access-course', $course2));
        $this->assertEquals($coupon->fresh()->uses_left, 0);
    }
}
