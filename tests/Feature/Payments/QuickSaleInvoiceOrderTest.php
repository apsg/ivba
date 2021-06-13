<?php
namespace Tests\Feature\Payments;

use App\Order;
use App\QuickSale;
use App\User;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class QuickSaleInvoiceOrderTest extends TestCase
{
    /**
     * @var QuickSale
     */
    private $quickSale;

    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->quickSale = factory(QuickSale::class)->create();
        $this->user = $this->createUserNoAccess();
    }

    /** @test */
    public function it_saves_final_total_when_order_is_confirmed()
    {
        Event::fake();

        // given
        /** @var Order $order */
        $order = $this->user->getCurrentOrder();
        $order->quick_sales()->attach($this->quickSale->id);

        // when
        $order->confirm('abc');
        $order = $order->fresh();

        // then
        $this->assertNotNull($order->final_total);
    }

    /** @test */
    public function final_total_is_unchanged_when_product_price_changes()
    {
        Event::fake();
        // given
        /** @var Order $order */
        $order = $this->user->getCurrentOrder();
        $order->quick_sales()->attach($this->quickSale->id);
        $oldPrice = $this->quickSale->price;
        $order->confirm('abc');
        $order = $order->fresh();

        // when
        $this->quickSale->update([
            'price' => $oldPrice + 1,
        ]);
        $this->quickSale = $this->quickSale->fresh();

        // then
        $this->assertNotEquals($oldPrice, $this->quickSale->price);
        $this->assertEquals($oldPrice, $order->final_total);
        $this->assertEquals($oldPrice, $order->total());
    }
}
