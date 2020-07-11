<?php
namespace App\Domains\Quicksales\Listeners;

use App\Domains\Quicksales\Integrations\GetResponseService;
use App\Events\QuickSaleConfirmedEvent;

class TrySubscribeToGetresponseListener
{
    /**
     * @var GetResponseService|\Illuminate\Foundation\Application
     */
    private $service;

    public function __construct()
    {
        $this->service = app(GetResponseService::class);
    }

    public function handle(QuickSaleConfirmedEvent $event)
    {
        if ($event->quicksale === null
            || $event->user === null
            || empty($event->quicksale->campaign)) {
            return;
        }

        try {
            $this->service->addToCampaign($event->quicksale->campaign, $event->user);
        } catch (\Exception $exception) {
            // do nothing
        }
    }
}
