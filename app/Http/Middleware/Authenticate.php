<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if ($request->route()->getPrefix() == '/admin') {
            return route('admin.login');
        }
        if ($request->route()->getPrefix() == '/merchant') {
            return route('merchant.login');
        }
        if ($request->route()->getPrefix() == '/user') {
            return route('user.login');
        }
        if ($request->route()->getPrefix() == 'api/admin') {
            return response()->json([
                'message' => 'UnAuthenticated',
                'data' => 'Invalid token or token expired.'
            ], 401);
        }
        if ($request->route()->getPrefix() == 'api/merchant') {
            return response()->json([
                'message' => 'UnAuthenticated',
                'data' => 'Invalid token or token expired.'
            ], 401);
        }
        if ($request->route()->getPrefix() == 'api/user') {
            return response()->json([
                'message' => 'UnAuthenticated',
                'data' => 'Invalid token or token expired.'
            ], 401);
        }
        return route('login');
    }
}
