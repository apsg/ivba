<?php

namespace App\Policies;

use App\User;
use App\UserCertificate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserCertificatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user certificate.
     *
     * @param \App\User            $user
     * @param \App\UserCertificate $userCertificate
     * @return mixed
     */
    public function view(User $user, UserCertificate $userCertificate)
    {
        if ($user->isadmin) {
            return true;
        }

        return $userCertificate->user->id === $user->id;
    }
}
