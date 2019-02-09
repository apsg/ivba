<?php
namespace App\Console\Commands;

use App\Followup;
use Illuminate\Console\Command;

class SendPlannedFollowups extends Command
{
    protected $signature = 'iexcel:followups';

    protected $description = 'Wyszukaj zaplanowane followupy i wyślij je';

    public function handle()
    {
        Followup::where('is_sent', 0)
            ->where('send_at', '<=', \Carbon\Carbon::now())
            ->get()
            ->each->send();
    }
}
