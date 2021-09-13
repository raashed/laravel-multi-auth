<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->expectsJson()) {
            return route('user.login');
        }

        return $next($request);
    }
}
