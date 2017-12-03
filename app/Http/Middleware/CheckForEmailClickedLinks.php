<?php

namespace App\Http\Middleware;

use Closure;

class CheckForEmailClickedLinks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if( isset( $request->eid ) ){
            $email = \App\Email::find($request->eid);
            if($email && is_null($email->clicked_at)){
                if( ! $request->is('unsubscribe/*') ){
                    $email->update([
                        'clicked_at' => \Carbon\Carbon::now()
                    ]);
                }
            }
        }

        return $next($request);
    }
}
