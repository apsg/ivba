<?php
namespace Tests\Feature\Integrations\Getresponse;

use App\Domains\Quicksales\Integrations\GetResponseService;
use Tests\TestCase;

class GetResponseServiceTest extends TestCase
{
    /** @test */
    public function it_returns_campaigns_list()
    {
        // given
        $service = $this->app->make(GetResponseService::class);

        // when
        $result = $service->getCampaigns();

        // then
        dd($result);
    }
}