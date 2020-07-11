<?php
namespace App\Exceptions;

class NoCouponUsesLeftException extends \Exception
{
    protected $code = 405;
    protected $message = 'No uses left';
}
