<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class IsAdmin
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::user()->admin) {
            return redirect('/');
        }
        return $next($request);
    }
}