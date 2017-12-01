<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendPlannedFollowups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:followups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wyszukaj zaplanowane followupy i wyślij je';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fups = \App\Followup::where('is_sent', 0)
            ->where('send_at', '<=', \Carbon\Carbon::now())
            ->get()
            ->each->send();
    }
}
