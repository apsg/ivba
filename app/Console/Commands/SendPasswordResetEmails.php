<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendPasswordResetEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:maile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $c = new \App\Http\Controllers\Auth\ForgotPasswordController;


        $users = \App\User::whereNotNull('full_access_expires')->get();

        foreach ($users as $user) {
            $c->broker()->sendResetLink([
                'email' => $user->email
                ]);
        }
    }
}
