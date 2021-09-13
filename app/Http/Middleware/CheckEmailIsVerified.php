<?php /** @noinspection PhpVoidFunctionResultUsedInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CheckEmailIsVerified extends EnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!$request->user() || ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail())) {
            if ($request->route()->getPrefix() == '/admin') {
                return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'admin.verification.notice'));
            }
            if ($request->route()->getPrefix() == '/merchant') {
                return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'merchant.verification.notice'));
            }
            if ($request->route()->getPrefix() == '/user') {
                return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'user.verification.notice'));
            }

            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        return $next($request);
    }
}
