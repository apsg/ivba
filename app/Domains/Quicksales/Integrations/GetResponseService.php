<?php
namespace App\Domains\Quicksales\Integrations;

use App\User;
use Cache;
use Getresponse\Sdk\Client\GetresponseClient;
use Getresponse\Sdk\Client\Operation\Operation;
use Getresponse\Sdk\Client\Operation\OperationResponse;
use Getresponse\Sdk\Client\Operation\Pagination;
use Getresponse\Sdk\GetresponseClientFactory;
use Getresponse\Sdk\Operation\Campaigns\GetCampaigns\GetCampaigns;
use Getresponse\Sdk\Operation\Campaigns\GetCampaigns\GetCampaignsSearchQuery;
use Getresponse\Sdk\Operation\Contacts\CreateContact\CreateContact;
use Getresponse\Sdk\Operation\Contacts\GetContacts\GetContacts;
use Getresponse\Sdk\Operation\Model\CampaignReference;
use Getresponse\Sdk\Operation\Model\NewContact;

class GetResponseService
{
    /** @var GetresponseClient */
    private $client;

    public function __construct()
    {
        if (empty(config('services.getresponse.key'))) {
            throw new GetResponseException('Missing api key');
        }

        $this->client = GetresponseClientFactory::createWithApiKey(config('services.getresponse.key'));
    }

    public function getCampaigns() : array
    {
        return Cache::remember('getresponse_campaigns', 2, function () {
            return $this->getFullData((new GetCampaigns())->setQuery(new GetCampaignsSearchQuery()));
        });
    }

    public function addToCampaign(string $campaignId, User $user) : OperationResponse
    {
        $campaign = new CampaignReference($campaignId);
        $contact = new NewContact($campaign, $user->email);
        $contact->setName($user->full_name);
        $contact->setDayOfCycle(0);

        return $this->client->call(new CreateContact($contact));
    }

    public function getContacts()
    {
        return $this->client->call(new GetContacts());
    }

    protected function getFullData(Operation $operation) : array
    {
        $data = [];
        $page = 0;

        while (true) {
            $response = $this->client->call((new GetCampaigns())
                ->setPagination(new Pagination($page, 100)))
                ->getData();

            $data = array_merge($data, $response);
            $page++;

            if (empty($response)) {
                break;
            }
        }

        return $data;
    }
}
