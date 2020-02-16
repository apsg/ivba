<?php
namespace Tests\Feature\Controllers;

use App\AccessDay;
use App\Order;
use App\Repositories\AccessDaysRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EasyAccessControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @var User */
    protected $user;

    /** @var float */
    protected $singlePrice;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->singlePrice = Setting::get('ivba.subscription_price');

        $this->withoutNotifications();
    }

    /** @test */
    public function it_checks_route_exists_and_returns_proper_view()
    {
        // given
        $url = url('/easy_access');

        // when
        $response = $this->get($url);

        // then
        $response->assertStatus(302);

        // when
        $response = $this->actingAs($this->user)
            ->get($url);

        // then
        $response->assertStatus(200);
        $response->assertSeeText('Wykup dostęp');
    }


    /**
     * @test
     * @dataProvider durations
     */
    public function it_should_add_orderable_item_to_cart_when_user_clicks_on_easy_access($duration, $resultShouldBeOk)
    {
        // given
        $url = url('easy_access/add/' . $duration);
        $price = $this->singlePrice * $duration;

        // when
        $response = $this->actingAs($this->user)->get($url);

        /** @var Order $order */
        $order = $this->user->getCurrentOrder();

        // then
        if ($resultShouldBeOk) {
            $response->assertSessionDoesntHaveErrors();
            $response->assertRedirect('/cart');
            $this->assertEquals($duration, $order->duration);
            $this->assertEquals($price, $order->price);
            $this->assertTrue((bool)$order->is_easy_access);
            $this->assertFalse((bool)$order->is_full_access);
        } else {
            $response->assertRedirect('/');
            $response->assertSessionHasErrors();
        }
    }

    public function durations()
    {
        return [
            [1, true],
            [3, true],
            [6, true],
            [2, false],
            [5, false],
            [7, false],
        ];
    }

    /** @test */
    public function it_checks_that_confirming_order_grants_access_days()
    {
        // given
        $order = $this->user->getCurrentOrder();
        $order->setEasyAccess(3);

        // when
        $order->confirm('test');

        $currentDay = $this->user
            ->days()
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->first();
        $lastDay = app(AccessDaysRepository::class)->getLastAccessDay($this->user);

        // then
        $this->assertNotNull($currentDay);
        $this->assertInstanceOf(AccessDay::class, $currentDay);
        $this->assertFalse($lastDay->isToday());
        $this->assertGreaterThan(3 * 30 - 2, $lastDay->diffInDays());
    }
}
