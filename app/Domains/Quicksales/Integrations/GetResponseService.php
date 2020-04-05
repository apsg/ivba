<?php
namespace App\Domains\Quicksales\Integrations;

use Getresponse\Sdk\Client\GetresponseClient;
use Getresponse\Sdk\GetresponseClientFactory;
use Getresponse\Sdk\Operation\Campaigns\GetCampaigns\GetCampaigns;

class GetResponseService
{
    /** @var GetresponseClient */
    private $client;

    public function __construct()
    {
        $this->client = GetresponseClientFactory::createWithApiKey(config('services.getresponse.key'));
    }

    public function getCampaigns() : array
    {
        return $this->client->call(new GetCampaigns())->getData();
    }
}