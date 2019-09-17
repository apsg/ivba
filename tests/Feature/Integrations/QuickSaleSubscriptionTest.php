<?php
namespace Tests\Feature\Integrations;

use App\QuickSale;
use App\Repositories\SubscriptionRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\UserConcerns;
use Tests\TestCase;

class QuickSaleSubscriptionTest extends TestCase
{
    use InteractsWithDatabase, DatabaseTransactions;
    use UserConcerns;
    use WithFaker;

    /** @var User */
    protected $user;

    /** @var QuickSale */
    protected $quickSale;

    protected function setUp()
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->quickSale = factory(QuickSale::class)->create([
            'file_url' => $this->faker->url,
        ]);
    }

    /** @test */
    public function should_not_cancel_users_full_access_when_buying_quick_sale_item()
    {
        // given
        $this->user->update([
            'full_access_expires' => Carbon::now()->addMonth(),
        ]);

        $order = $this->user->fresh()->getCurrentOrder();
        $order->quick_sales()->save($this->quickSale);
        $order = $order->fresh();
        $this->actingAs($this->user);

        // when
        $order->confirm('test');
        $this->user = $this->user->fresh();

        // then
        $this->assertNotNull($this->user->full_access_expires);
        $this->assertTrue($this->user->full_access_expires->isFuture());
    }

    /** @test */
    public function should_not_cancel_users_subscription_when_buying_quick_sale_item()
    {
        // given
        $repository = app(SubscriptionRepository::class);

        $subscription = $repository->create($this->user);
        $repository->makeActive($subscription, 'test');

        $order = $this->user->fresh()->getCurrentOrder();
        $order->quick_sales()->save($this->quickSale);
        $order = $order->fresh();
        $this->actingAs($this->user);

        // when
        $order->confirm('test');
        $this->user = $this->user->fresh();

        // then
        $this->assertNotNull($this->user->activeSubscription());
    }
}
