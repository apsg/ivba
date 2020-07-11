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

    /** @test */
    public function it_finds_user_added_to_list()
    {
        // given
        $user = $this->createUser();
        $campaignId = $this->service->getCampaignId('test_wszyscy');
        $campaignId2 = $this->service->getCampaignId('test_aktywni');
        $this->service->addToCampaign(
            $campaignId,
            $user
        );
        $this->service->addToCampaign(
            $campaignId2,
            $user
        );

        // when
        $id1 = $this->service->getContactIdFromCampaign($campaignId, $user);
        $id2 = $this->service->getContactIdFromCampaign($campaignId2, $user);

        // then
        $this->assertNotEmpty($id1);
        $this->assertNotEmpty($id2);
        $this->assertNotEquals($id1, $id2);
    }

    /** @test */
    public function it_removes_user_from_list()
    {
        // given
        $user = $this->createUser();
        $campaignId = $this->service->getCampaignId('test_wszyscy');
        $this->service->addToCampaign(
            $campaignId,
            $user
        );
        $id1 = $this->service->getContactIdFromCampaign($campaignId, $user);
        $this->assertNotEmpty($id1);

        // when
        $this->service->removeFromCampaign($campaignId, $user);

        // then
        $this->assertEmpty($this->service->getContactIdFromCampaign($campaignId, $user));
    }
}
