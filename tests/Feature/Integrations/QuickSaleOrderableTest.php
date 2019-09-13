<?php
namespace Tests\Feature\Integrations;

use App\Course;
use App\QuickSale;
use App\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\CourseConcerns;
use Tests\Concerns\UserConcerns;
use Tests\TestCase;

class QuickSaleOrderableTest extends TestCase
{
    use InteractsWithDatabase, DatabaseTransactions;
    use CourseConcerns;
    use UserConcerns;
    use WithFaker;

    /** @var User */
    protected $user;

    /** @var QuickSale */
    protected $quickSale;

    /** @var Course */
    protected $course;

    protected function setUp()
    {
        parent::setUp();

        $this->course = $this->createCourse(1);
        $this->user = $this->createUser();
        $this->quickSale = factory(QuickSale::class)->create([
            'course_id' => $this->course->id,
        ]);
    }

    /** @test */
    public function should_attach_quick_sale_to_order()
    {
        // given
        $order = $this->user->getCurrentOrder();

        // when
        $order->quick_sales()->save($this->quickSale);
        $order = $order->fresh();

        // then
        $this->assertCount(1, $order->quick_sales);
        $this->assertEquals($this->quickSale->price, $order->sum());
    }

    /** @test */
    public function should_give_user_access_to_course_if_order_is_confirmed()
    {
        // given
        $order = $this->user->getCurrentOrder();
        $order->quick_sales()->save($this->quickSale);
        $order = $order->fresh();
        $this->actingAs($this->user);

        // when
        $order->confirm('test');

        // then
        $this->assertTrue(\Gate::allows('access', $this->course));
        $this->assertTrue(\Gate::allows('access', $this->course->lessons[0]));

        // when
        $response = $this->actingAs($this->user)
            ->get('/account');

        $response->assertSee($this->course->title);
    }

    /** @test */
    public function user_can_download_quicksale_item_on_his_account_page()
    {
        // given
        $url = $this->faker->url;
        $quickSale = factory(QuickSale::class)->create([
            'file_url' => $url,
        ]);
        $order = $this->user->getCurrentOrder();
        $order->quick_sales()->save($quickSale);
        $order = $order->fresh();
        $this->actingAs($this->user);

        // when
        $order->confirm('test');

        // then
        $this->actingAs($this->user)
            ->get('/account')
            ->assertSee($url);
    }
}
