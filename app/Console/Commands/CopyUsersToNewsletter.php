<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CopyUsersToNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iexcel:newsletter_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kopiuje użytkowników do newslettera';

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
        $users = \App\User::all();

        foreach ($users as $user) {
            \App\NewsletterSubscriber::firstOrCreate([
                'email' => $user->email,
            ])->update([
                'name'  => $user->name,
            ]);
        }
    }
}
