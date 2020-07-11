<?php
namespace App\Listeners\Getresponse;

use App\Domains\Quicksales\Integrations\GetResponseService;

class RemoveUserFromGetresponseActiveList extends AbstractGetresponseListener
{
    protected $remove = [
        GetResponseService::ACTIVE_LIST_KEY,
    ];
}