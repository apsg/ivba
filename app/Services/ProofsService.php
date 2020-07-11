<?php
namespace App\Services;

use App\Proof;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProofsService
{
    public function nextForUser(User $user)
    {
        if ($this->isTimeForNextProof($user->last_proof_at)) {
            return Proof::getNextForUser($user);
        }

        return null;
    }

    public function nextForUnregistered(Request $request)
    {
        if ($this->isTimeForNextProof(Carbon::parse($request->cookie('last_proof_at', '2018-01-01')))) {
            $proof = Proof::getNextUnregistered($request->cookie('last_proof_id', 0));

            if ($proof !== null) {
                Cookie::queue('last_proof_at', Carbon::now(), 24 * 60);
                Cookie::queue('last_proof_id', $proof->id, 24 * 60);
            }

            return $proof;
        }

        return null;
    }

    protected function isTimeForNextProof(Carbon $date = null) : bool
    {
        if ($date === null) {
            return true;
        }

        return $date->diffInMinutes() > 1;
    }
}
