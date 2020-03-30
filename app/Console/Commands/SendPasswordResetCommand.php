<?php

namespace App\Console\Commands;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Console\Command;

class SendPasswordResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send password reset email';

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
        $id = $this->argument('id');

        app(UserRepository::class)->resetPassword(User::find($id));
    }
}
