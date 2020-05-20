<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $sho = false;

        if (($request->path() != 'login') && !Auth::check()) {
            return redirect()->route('login');
        }

        //dd($sho);

        return $next($request);
    }
}
