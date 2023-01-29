<?php

namespace App\Http\Controllers\Web\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected string $redirectTo = RouteServiceProvider::MERCHANT_HOME;

    public function __construct()
    {
        $this->middleware('auth:merchant');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('merchant.auth.verify');
    }

    public function resend(Request $request): JsonResponse|Redirector|RedirectResponse|Application
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
            ? new JsonResponse([], 202)
            : back()->with('resent', true);
    }
}
