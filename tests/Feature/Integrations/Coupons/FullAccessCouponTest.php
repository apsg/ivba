<?php
namespace Tests\Feature\Integrations\Coupons;

use App\Coupon;
use App\Domains\Payments\Repositories\CouponRepository;
use Tests\TestCase;

class FullAccessCouponTest extends TestCase
{
    /**
     * @var Coupon
     */
    private $coupon;

    protected function setUp()
    {
        parent::setUp();

        $this->coupon = $this->app->make(CouponRepository::class)->generateFullAccess(10);
    }

    /** @test */
    public function coupon_was_created()
    {
        $this->assertNotNull($this->coupon);
        $this->assertEquals(Coupon::TYPE_FULL_ACCESS, $this->coupon->type);
    }

    /** @test */
    public function user_can_use_coupon_and_it_grants_him_full_access()
    {
        // given
        $user = $this->createUser([
            'full_access_expires' => null,
        ]);
        $this->actingAs($user);
        $this->assertFalse($user->hasFullAccess());

        // when
        $this->coupon->use();

        // then
        $this->assertTrue($user->hasFullAccess());
        $this->assertTrue($user->full_access_expires->isFuture());
        $this->assertGreaterThan(360, $user->full_access_expires->diffInDays());
    }

    /** @test */
    public function user_can_redeem_coupon_by_code()
    {
        // given
        $user = $this->createUser([
            'full_access_expires' => null,
        ]);
        $code = $this->coupon->code;

        // when
        $this->actingAs($user)
            ->post(route('coupon.redeem'), [
                'code' => $code,
            ]);

        // then
        $this->assertTrue($user->hasFullAccess());
        $this->assertTrue($user->full_access_expires->isFuture());
        $this->assertGreaterThan(360, $user->full_access_expires->diffInDays());

    }

    /** @test */
    public function user_can_use_coupon_only_once()
    {
        // given
        $user = $this->createUser([
            'full_access_expires' => null,
        ]);
        $this->assertFalse($user->hasFullAccess());

        // when
        $this->actingAs($user);
        $this->coupon->use();
        $this->coupon->use();

        // then
        $this->assertTrue($user->hasFullAccess());
        $this->assertTrue($user->full_access_expires->isFuture());
        $this->assertGreaterThan(360, $user->full_access_expires->diffInDays());
        $this->assertLessThan(370, $user->full_access_expires->diffInDays());
    }
}