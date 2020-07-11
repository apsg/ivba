<?php
namespace Tests\Feature\Integrations\Getresponse;

use App\Domains\Quicksales\Integrations\GetResponseService;
use App\User;
use Illuminate\Support\Arr;
use Tests\TestCase;

class GetResponseServiceTest extends TestCase
{
    /**
     * @var GetResponseService
     */
    private $service;

    protected function setUp()
    {
        parent::setUp();

        $this->service = $this->app->make(GetResponseService::class);
    }

    /** @test */
    public function it_returns_campaigns_list()
    {
        // given

        // when
        $result = $this->service->getCampaigns();

        // then
        $this->assertTrue(is_array($result));
    }

    /** @test */
    public function it_creates_new_contact()
    {
        // given
        $user = User::where(
            'email', 'szymon.gackowski@gmail.com',
        )->first();
        $campaignId = 'WBe15'; // mateuszgr - lista

        // when
        $result = $this->service->addToCampaign($campaignId, $user);

        // then
        $this->assertTrue($result->isSuccess());
    }

    /** @test */
    public function it_returns_contacts()
    {
        // given

        // when
        $result = $this->service->getContacts()->getData();

        // then
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    /** @test */
    public function it_finds_campaign_by_its_name()
    {
        // given
        $name = 'test_aktywni';

        // when
        $campaignData = $this->service->getCampaign($name);

        // then
        $this->assertNotEmpty($campaignData);
        $this->assertArrayHasKey('campaignId', $campaignData);
        $this->assertArrayHasKey('name', $campaignData);
        $this->assertEquals($name, Arr::get($campaignData, 'name'));
    }
}
