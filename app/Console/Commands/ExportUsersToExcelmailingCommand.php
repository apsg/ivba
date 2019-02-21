<?php

namespace App\Console\Commands;

use App\User;
use Gacek\IExcel\IExcel;
use Illuminate\Console\Command;

class ExportUsersToExcelmailingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivba:export_to_excelmailing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all current users to excelmailing';

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
        $users = User::with('subscription')->get();

        $excelmailing = app(IExcel::class)->excelmailing();

        $this->info('Exporting to excelmailing');

        $bar = $this->output->createProgressBar($users->count());

        foreach ($users as $user) {

            $bar->advance();

            if ($user->subscription === null && $user->full_access_expires === null) {
                $excelmailing->register($user->email);
                continue;
            }

            if (($user->full_access_expires !== null && $user->full_access_expires->isFuture())
                || ($user->subscription !== null && $user->subscription->valid_until->isFuture())) {
                $excelmailing->access($user->email);
                continue;
            }

            if (($user->full_access_expires !== null && $user->full_access_expires->isPast())
                || ($user->subscription !== null && $user->subscription->valid_until->isPast())) {
                $excelmailing->expired($user->email);
                continue;
            }
        }

        $bar->finish();
    }
}
