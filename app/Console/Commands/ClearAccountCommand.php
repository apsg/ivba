<?php
namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ClearAccountCommand extends Command
{

    protected $signature = 'user:clear {user}';

    protected $description = 'Kopiuje użytkowników do newslettera';

    public function handle()
    {
        /** @var User $user */
        $user = User::findOrFail($this->argument('user'));

        $user->subscriptions()->delete();
        $user->update([
            'full_access_expires' => null,
        ]);
        $this->info('Done');
    }
}