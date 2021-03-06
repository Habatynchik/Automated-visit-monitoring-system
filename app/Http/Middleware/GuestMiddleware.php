<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class estMiddleware
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
        if (($request->path() != 'login') && !Auth::check()) {
            return redirect()->route('login');
            //return redirect()->intended('login');
        }

        return $next($request);
    }
}
