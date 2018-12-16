<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Entrust;

class AuthUser
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
        if(!Auth::check()) {
            return redirect('/login')->with('info', 'You must be login !');
        }

        return $next($request);
    }
}
