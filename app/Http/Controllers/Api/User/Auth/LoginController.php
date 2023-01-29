<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = RouteServiceProvider::USER_HOME;

    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function showLoginForm(): Factory|View|Application
    {
        return view('user.auth.login');
    }

    protected function guard(): Guard|StatefulGuard
    {
        return Auth::guard('user');
    }
}
