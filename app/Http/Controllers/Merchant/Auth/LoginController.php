<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::MERCHANT_HOME;

    public function __construct()
    {
        $this->middleware('guest:merchant')->except('logout');
    }

    public function showLoginForm()
    {
        return view('merchant.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('merchant');
    }
}
