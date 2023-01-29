<?php

namespace App\Http\Controllers\Web\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected string $redirectTo = RouteServiceProvider::USER_HOME;

    public function showResetForm(Request $request): Factory|View|Application
    {
        $token = $request->route()->parameter('token');

        return view('user.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker(): PasswordBroker
    {
        return Password::broker('users');
    }

    protected function guard(): Guard|StatefulGuard
    {
        return Auth::guard('user');
    }
}
