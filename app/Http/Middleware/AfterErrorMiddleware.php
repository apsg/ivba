<?php
namespace App\Http\Middleware;

use App\Domains\Payments\Exceptions\UserExistsException;
use Closure;

class AfterErrorMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $next($request);
        } catch (UserExistsException $exception) {
            return $this->handleException($exception);
        }
    }

    protected function handleException(\Exception $exception)
    {
        return response($exception->getMessage(), $exception->getCode());
    }
}
