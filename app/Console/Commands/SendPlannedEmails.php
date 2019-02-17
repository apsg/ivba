<?php

namespace App\Console\Commands;

use App\Email;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
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

    public function handle()
    {
        try {
            $emailsToSend = Email::where('send_at', '<=', Carbon::now())
                ->where('is_sent', false)
                ->take(100)
                ->get();

            foreach ($emailsToSend as $email) {
                $email->send();
            }
        } catch (QueryException $exception) {
            // do nothing, it would be sent the next time
        }
    }
}
