<?php

namespace App\Console\Commands;

use App\Email;
use Illuminate\Console\Command;

class SendPlannedEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wysyła zaplanowane emaile';

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
        Email::where('send_at', '<=', \Carbon\Carbon::now())
            ->where('is_sent', false)
            ->take(100)
            ->get()
            ->each->send();
    }
}
