<?php
namespace Tests\Feature\Integrations;

use App\Fakturownia\Client\InvoiceOceanClient;
use App\InvoiceRequest;
use App\Order;
use App\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Tests\Concerns\OrdersConcerns;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use OrdersConcerns;
    use InteractsWithDatabase;
    use WithFaker;
    use MockeryPHPUnitIntegration;

    /** @var User */
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->actingAs($this->user);
    }

    /** @test */
    public function should_redirect_user_if_invoice_data_is_missing()
    {
        // given
        $order = $this->createOrder([
            'user_id' => $this->user->id,
        ]);

        // when
        $response = $this->actingAs($this->user)
            ->get(url('/order/' . $order->id . '/request-invoice'));

        // then
        $response->assertStatus(302)
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('invoice_requests', [
            'invoicable_id' => $order->id,
        ]);
    }

    /** @test */
    public function it_creates_invoice_request()
    {
        // given
        $order = $this->createOrder([
            'user_id' => $this->user->id,
        ]);

        $this->user->update([
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'taxid'      => '1234567890',
        ]);

        // when
        $response = $this->actingAs($this->user)
            ->get(url('/order/' . $order->id . '/request-invoice'));

        // then
        $response->assertStatus(302)
            ->assertSessionDoesntHaveErrors();

        $this->assertDatabaseHas('invoice_requests', [
            'invoicable_id'   => $order->id,
            'invoicable_type' => Order::class,
        ]);
    }

    /** @test */
    public function it_sends_create_invoice_request_if_invoice_is_confirmed()
    {
        // given
        $this->mock(InvoiceOceanClient::class, function ($mock) {
            $mock->shouldReceive('addInvoice')->once()->andReturn([
                'response' => [
                    'id' => 123,
                ],
            ]);
        });

        $order = $this->createOrder([
            'user_id' => $this->user->id,
        ]);
        $request = InvoiceRequest::create([
            'invoicable_id'   => $order->id,
            'invoicable_type' => Order::class,
        ]);

        // when
        $request->confirm();

        // then
        $this->assertNotNull($order->invoice_id);
    }
}
