<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::MERCHANT_HOME;

    public function __construct()
    {
        $this->middleware('auth.merchant');
    }

    public function showConfirmForm()
    {
        return view('merchant.auth.passwords.confirm');
    }
}
