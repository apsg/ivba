<?php
namespace App\Domains\Quicksales\Listeners;

use App\Domains\Quicksales\Integrations\GetResponseService;
use App\Domains\Quicksales\Integrations\MailerliteService;
use App\Events\QuickSaleConfirmedEvent;
use Exception;

class TrySubscribeToMailerliteGroupListener
{

    /**
     * @var GetResponseService
     */
    private $service;

    public function __construct()
    {
        $this->service = app(MailerliteService::class);
    }

    public function handle(QuickSaleConfirmedEvent $event)
    {
        if ($event->quicksale === null
            || $event->user === null
            || empty($event->quicksale->mailerlite_group_id)) {
            return;
        }

        try {
            $this->service->addUserToGroup($event->user, $event->quicksale->mailerlite_group_id);
        } catch (Exception $exception) {
            // do nothing
        }
    }
}
