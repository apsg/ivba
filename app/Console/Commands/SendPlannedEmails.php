<?php

namespace App\Console\Commands;

use App\Email;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Console\Command;
use Swift_RfcComplianceException;

class SendPlannedEmails extends Command
{
    protected $signature = 'iexcel:emails';

    protected $description = 'Wysyła zaplanowane emaile';

    public function handle()
    {
        try {
            $emailsToSend = Email::where('send_at', '<=', Carbon::now())
                ->where('is_sent', false)
                ->take(100)
                ->get();

            try {
                /** @var Email $email */
                foreach ($emailsToSend as $email) {
                    $email->send();
                }
            } catch (Swift_RfcComplianceException $exception) {
                $email->delete();
            }

        } catch (QueryException $exception) {
            // do nothing, it would be sent the next time
        }
    }
}
