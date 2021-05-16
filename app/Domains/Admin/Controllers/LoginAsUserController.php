<?php
namespace App\Domains\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class LoginAsUserController extends Controller
{
    public function login(string $data)
    {
        $decryptedData = Crypt::decrypt($data);

        $validDate = Carbon::createFromTimestamp($decryptedData['valid_to']);

        if ($validDate->isPast()) {
            return 'Outdated';
        }

        $user = User::findOrFail($decryptedData['id']);

        auth()->logout();
        auth()->login($user);

        return redirect('/account');
    }
}
