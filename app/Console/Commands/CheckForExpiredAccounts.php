<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckForExpiredAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sprawdza, czy wygasły jakieś konta';

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
        $last = \App\Option::get('last_account_expiry_check');
        
        if(!empty($last->value)){
            $lastDate = \Carbon\Carbon::parse($last->value);
        }else{
            $lastDate = \Carbon\Carbon::parse('2017-09-01');
        }

        $now = \Carbon\Carbon::now();

        $users = \App\User::where('full_access_expires', '>', $lastDate)
            ->where('full_access_expires', '<=', $now)
            ->get();

        foreach ($users as $user) {
            event(new \App\Events\UserPaidAccessFinished($user));
        }

        \App\Option::set('last_account_expiry_check', $lastDate);
    }
}
