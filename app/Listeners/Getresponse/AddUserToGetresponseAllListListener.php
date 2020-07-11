<?php
namespace App\Listeners\Getresponse;

use App\Domains\Quicksales\Integrations\GetResponseService;

class AddUserToGetresponseAllListListener extends AbstractGetresponseListener
{
    protected $add = [
        GetResponseService::ALL_LIST_KEY,
    ];
}