<?php
namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;

class LoginAsUserCommand extends Command
{
    protected $signature = "login {user}";

    /** @var null|User */
    protected $user = null;

    public function handle()
    {
        $userEmailOrId = $this->argument('user');

        $user = $this->resolveUser($userEmailOrId);

        if ($this->confirm("Login as user {$user->id} ({$user->email})?")) {
            $this->user = $user;
        }

        $data = [
            'id'       => $this->user->id,
            'valid_to' => Carbon::now()->addMinutes(5)->timestamp,
        ];

        $encryptedData = Crypt::encrypt($data);

        $url = route('admin.login', ['data' => $encryptedData]);
        dd($url);
    }

    protected function resolveUser(string $userEmailOrId) : User
    {
        $user = null;

        if ((int)$userEmailOrId !== 0) {
            return User::find($userEmailOrId);
        }

        if (is_string($userEmailOrId)) {
            /** @var Collection $users */
            $users = User::where('email', 'like', "%{$userEmailOrId}%")
                ->orWhere('name', 'like', "%{$userEmailOrId}%")
                ->get();

            if ($users->count() === 0) {
                $this->error('No users found');
                exit();
            }

            $email = $this->choice('Select user',
                $users->pluck('email')->toArray()
            );

            $user = User::where('email', $email)->first();
        }

        return $user;
    }
}
