<?php
namespace App\Console\Commands;

use App\Domains\Quicksales\Integrations\MailerliteService;
use Apsg\Baselinker\Facades\Baselinker;
use Illuminate\Console\Command;
use function config;

class TestServicesCommand extends Command
{
    protected $signature = 'services:test';

    public function handle()
    {
        try {
            $this->testBaselinker();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        };

        try {
            $this->testGetresponse();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }

        try {
            $this->testMailerlite();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    protected function testBaselinker()
    {
        $this->info("Testing connection to baselinker");
        $this->info("Baselinker token: " . config('baselinker.token'));

        $products = Baselinker::products()->getProductsList();

        $this->info('Products received: ' . count($products));
    }

    protected function testMailerlite()
    {
        $this->info('Testign Mailerlite');
        $this->info("Using token: " . config('services.mailerlite.key'));
        $groups = app(MailerliteService::class)->getGroups();
        $this->info("Groups received: " . count_chars($groups));
    }
}
