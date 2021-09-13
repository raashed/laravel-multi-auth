<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::USER_HOME;

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function showConfirmForm()
    {
        return view('user.auth.passwords.confirm');
    }
}
