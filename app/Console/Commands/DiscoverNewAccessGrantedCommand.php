<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiscoverNewAccessGrantedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivba:discover_access';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sprawdza, czy użytkownicy dostali nowy dostęp';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}
