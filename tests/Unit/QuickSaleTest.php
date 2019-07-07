<?php
namespace Tests\Unit;

use App\Interfaces\OrderableContract;
use App\QuickSale;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Concerns\CourseConcerns;
use Tests\TestCase;

class QuickSaleTest extends TestCase
{
    use CourseConcerns;
    use InteractsWithDatabase;
    use DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();

        $this->createCourse(1);
    }

    /** @test */
    public function it_creates_quick_sale_object()
    {
        // given

        // when
        $object = factory(QuickSale::class)->create();

        // then
        $this->assertNotNull($object->id);
        $this->assertInstanceOf(QuickSale::class, $object);
        $this->assertDatabaseHas('quick_sales', [
            'id'   => $object->id,
            'name' => $object->name,
        ]);
        $this->assertInstanceOf(OrderableContract::class, $object);
    }
}
