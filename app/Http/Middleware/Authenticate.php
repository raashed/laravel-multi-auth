<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->route()->getPrefix() == '/admin') {
                return route('admin.login');
            }
            if ($request->route()->getPrefix() == '/merchant') {
                return route('merchant.login');
            }
            if ($request->route()->getPrefix() == '/user') {
                return route('user.login');
            }
            dd('dd');
            return route('login');
        }
    }
}
