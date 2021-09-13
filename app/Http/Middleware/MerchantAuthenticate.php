<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MerchantAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return route('merchant.login');
        }

        return $next($request);
    }
}
