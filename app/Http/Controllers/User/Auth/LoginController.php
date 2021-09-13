<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::USER_HOME;

    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }
}
