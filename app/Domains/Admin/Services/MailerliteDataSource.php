<?php
namespace App\Domains\Admin\Services;

use App\Domains\Quicksales\Integrations\MailerliteService;

class MailerliteDataSource extends SettingsSelectDataSource
{
    protected MailerliteService $mailerliteService;

    public function __construct(MailerliteService $mailerLiteService)
    {
        $this->mailerliteService = $mailerLiteService;
    }

    public function toArray(): array
    {
        return collect($this->mailerliteService->getGroupsRawLoop())
            ->mapWithKeys(function (\stdClass $item) {
                return [
                    $item->id => $item->name,
                ];
            })
            ->toArray();
    }
}
