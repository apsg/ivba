<?php
namespace App\Listeners\Getresponse;

use App\Domains\Admin\Models\Setting;
use App\Domains\Quicksales\Integrations\GetResponseService;
use App\User;
use Exception;
use Log;

class AbstractGetresponseListener
{
    /** @var GetResponseService */
    protected $service;

    /** @var array */
    protected $remove = [];

    /** @var array */
    protected $add = [];

    public function __construct(GetResponseService $service)
    {
        $this->service = $service;
    }

    public function handle($event)
    {
        $user = object_get($event, 'user');
        if ($user === null || ! ($user instanceof User)) {
            return;
        }

        foreach ($this->add as $list) {
            $this->addToList($user, $list);
        }

        foreach ($this->remove as $list) {
            $this->removeFromList($user, $list);
        }
    }

    protected function addToList(User $user, string $listKeyName)
    {
        try {
            $list = Setting::get($listKeyName);

            if (empty($list)) {
                return;
            }

            $campaignId = $this->service->getCampaignId($list);
            $this->service->addToCampaign($campaignId, $user);
        } catch (Exception $exception) {
            Log::error(__CLASS__, [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    protected function removeFromList(User $user, string $listName)
    {
        try {
            $list = Setting::get($listName);

            if (empty($list)) {
                return;
            }

            $campaignId = $this->service->getCampaignId($list);
            $this->service->removeFromCampaign($campaignId, $user);
        } catch (Exception $exception) {
            Log::error(__CLASS__, [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    protected function retrieveUser($event) : ?User
    {
        $user = object_get($event, 'user');

        if ($user instanceof User) {
            return $user;
        }

        $user = object_get($event, 'subscription.user');

        if ($user instanceof User) {
            return $user;
        }

        return null;
    }
}
