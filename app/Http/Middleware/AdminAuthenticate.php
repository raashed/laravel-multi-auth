<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return route('admin.login');
        }

        return $next($request);
    }
}
