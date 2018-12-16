<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Entrust;

class AuthAdmin
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
        if(Auth::check()) {
            if (Entrust::hasRole('admin')) {
                return $next($request);
            } else {
                return redirect('/')->with('danger', 'You don\'t have access in this part !');
            }
        } else {
            return redirect('admin/login')->with('info', 'You must be login !');
        }
    }
}
