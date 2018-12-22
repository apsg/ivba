<?php
namespace App\Observers;

use App\Email;

class EmailObserver
{
    public function creating(Email $email)
    {
        $email->unsubscribe_code = uniqid();
    }

    public function updated(Email $email)
    {
        //
    }

    public function deleted(Email $email)
    {
        //
    }

    public function restored(Email $email)
    {
        //
    }

    public function forceDeleted(Email $email)
    {
        //
    }
}
