<?php

namespace App\Http\Middleware;

use Closure;

class WelcomeMiddleware
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
        if (\Request::is('login')||\Request::is('/')) {
            $user = \Auth::user();
            if ($user) {
                return redirect('/home');
            }
        }
    }
}
