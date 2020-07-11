<?php
namespace App\Listeners\Getresponse;

use App\Domains\Quicksales\Integrations\GetResponseService;

class RemoveUserFromGetresponseActiveList extends AbstractGetresponseListener
{
    protected $add = [
        GetResponseService::ALL_LIST_KEY,
    ];

    protected $remove = [
        GetResponseService::ACTIVE_LIST_KEY,
    ];
}
