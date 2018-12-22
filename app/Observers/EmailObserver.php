<?php
namespace App\Observers;

use App\Email;

class EmailObserver
{
    public function creating(Email $email)
    {
        $email->unsubscribe_code = uniqid();
    }
}
