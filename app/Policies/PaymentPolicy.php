<?php
namespace App\Policies;

use App\Payment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Payment $payment)
    {
        return $user->id === $payment->subscription->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Payment $payment)
    {
        return $user->id === $payment->subscription->user_id;
    }

    public function delete(User $user, Payment $payment)
    {
        return false;
    }

    public function restore(User $user, Payment $payment)
    {
        return false;
    }

    public function forceDelete(User $user, Payment $payment)
    {
        return false;
    }

    public function pay(User $user, Payment $payment)
    {
        return true;

        return $user->id === $payment->subscription->user_id;
    }
}
