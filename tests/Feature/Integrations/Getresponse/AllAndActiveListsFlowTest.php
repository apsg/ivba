<?php
namespace Tests\Feature\Integrations\Getresponse;

use App\Domains\Admin\Models\Setting;
use App\Domains\Quicksales\Integrations\GetResponseService;
use App\Events\UserPaidAccessFinished;
use App\Events\UserPaidForAccess;
use App\Events\UserRegisteredEvent;
use Tests\TestCase;

class AllAndActiveListsFlowTest extends TestCase
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
    public function it_tests_the_flow()
    {
        // given
        $user = $this->createUser();
        $allCampaign = $this->service->getCampaignId(Setting::get(GetResponseService::ALL_LIST_KEY));
        $activeCampaign = $this->service->getCampaignId(Setting::get(GetResponseService::ACTIVE_LIST_KEY));

        // when
        event(new UserRegisteredEvent($user));

        // then
        $this->assertNotEmpty($this->service->getContactIdFromCampaign($allCampaign, $user));
        $this->assertEmpty($this->service->getContactIdFromCampaign($activeCampaign, $user));

        // when
        event(new UserPaidForAccess($user));

        // then
        $this->assertEmpty($this->service->getContactIdFromCampaign($allCampaign, $user));
        $this->assertNotEmpty($this->service->getContactIdFromCampaign($activeCampaign, $user));

        // when
        event(new UserPaidAccessFinished($user));

        // then
        $this->assertNotEmpty($this->service->getContactIdFromCampaign($allCampaign, $user));
        $this->assertEmpty($this->service->getContactIdFromCampaign($activeCampaign, $user));
    }
}
