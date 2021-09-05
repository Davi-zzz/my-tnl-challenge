<?php
namespace App\Http\Middleware;

use Closure;

class MyAuthentication
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(session()->has('token')) {
            return $next($request);
        } 
            return response('Unauthorized.', 401);
    }
}