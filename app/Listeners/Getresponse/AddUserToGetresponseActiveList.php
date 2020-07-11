<?php
namespace App\Listeners\Getresponse;

use App\Domains\Quicksales\Integrations\GetResponseService;

class AddUserToGetresponseActiveList extends AbstractGetresponseListener
{
    protected $add = [
        GetResponseService::ACTIVE_LIST_KEY,
    ];

    protected $remove = [
        GetResponseService::ALL_LIST_KEY,
    ];
}
