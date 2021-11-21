<?php
namespace App\Domains\Payments\Exceptions;

class UserExistsException extends \Exception
{
    protected $code = 422;
    protected $message = "Posiadasz już konto, zaloguj się proszę!";
}
