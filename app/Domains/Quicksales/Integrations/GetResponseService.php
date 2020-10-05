<?php
namespace App\Domains\Quicksales\Integrations;

use App\User;
use Cache;
use Getresponse\Sdk\Client\GetresponseClient;
use Getresponse\Sdk\Client\Operation\Operation;
use Getresponse\Sdk\Client\Operation\OperationResponse;
use Getresponse\Sdk\Client\Operation\Pagination;
use Getresponse\Sdk\GetresponseClientFactory;
use Getresponse\Sdk\Operation\Campaigns\Contacts\GetContacts\GetContacts as GetCampaignContacts;
use Getresponse\Sdk\Operation\Campaigns\Contacts\GetContacts\GetContactsSearchQuery;
use Getresponse\Sdk\Operation\Campaigns\GetCampaigns\GetCampaigns;
use Getresponse\Sdk\Operation\Campaigns\GetCampaigns\GetCampaignsSearchQuery;
use Getresponse\Sdk\Operation\Contacts\CreateContact\CreateContact;
use Getresponse\Sdk\Operation\Contacts\DeleteContact\DeleteContact;
use Getresponse\Sdk\Operation\Contacts\GetContacts\GetContacts;
use Getresponse\Sdk\Operation\Model\CampaignReference;
use Getresponse\Sdk\Operation\Model\NewContact;
use Illuminate\Support\Arr;

class GetResponseService
{
    const CACHE_REMEMBER_MINUTES = 5;
    const ALL_LIST_KEY = 'ivba.getresponse.list_all';
    const ACTIVE_LIST_KEY = 'ivba.getresponse.list_active';

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
        return Cache::remember('getresponse_campaigns', static::CACHE_REMEMBER_MINUTES, function () {
            return $this->getFullData((new GetCampaigns())->setQuery(new GetCampaignsSearchQuery()));
        });
    }

    public function getCampaign(string $name) : array
    {
        return Cache::remember('getresponse_campaign_' . $name, static::CACHE_REMEMBER_MINUTES,
            function () use ($name) {
                $query = (new GetCampaignsSearchQuery())->whereName($name);

                return Arr::get(
                    $this->getFullData((new GetCampaigns())->setQuery($query)),
                    '0',
                    []
                );
            });
    }

    public function getCampaignId(string $name) : ?string
    {
        return Arr::get($this->getCampaign($name), 'campaignId');
    }

    public function addToCampaign(string $campaignId = null, User $user = null) : ?OperationResponse
    {
        if ($campaignId === null || $user === null) {
            return null;
        }

        $campaign = new CampaignReference($campaignId);
        $contact = new NewContact($campaign, $user->email);
        $contact->setName($user->full_name);
        $contact->setDayOfCycle(0);

        return $this->client->call(new CreateContact($contact));
    }

    public function removeFromCampaign(string $campaignId, User $user)
    {
        if (empty($campaignId) || $user === null) {
            return;
        }

        $contactId = $this->getContactIdFromCampaign($campaignId, $user);

        if (empty($contactId)) {
            return;
        }

        $this->client->call(new DeleteContact($contactId));
    }

    public function getContactIdFromCampaign(string $campaignId, User $user) : string
    {
        $query = (new GetCampaignContacts($campaignId))
            ->setQuery((new GetContactsSearchQuery())->whereEmail($user->email));

        $data = $this->getFullData($query);

        return Arr::get($data, '0.contactId', '');
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
            $response = $this->client->call(
                $operation
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
