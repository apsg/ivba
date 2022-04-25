<?php
namespace App\Domains\Microservice;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorizeMicroserviceMiddleware
{
    /**
     * @var Connector
     */
    protected $connector;

    public function __construct()
    {
        $this->connector = app(Connector::class);
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$this->connector->verifyHeader($request)) {
            return response('', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
