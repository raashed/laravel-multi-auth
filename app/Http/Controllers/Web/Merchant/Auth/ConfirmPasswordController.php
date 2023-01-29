<?php

namespace App\Http\Controllers\Web\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected string $redirectTo = RouteServiceProvider::MERCHANT_HOME;

    public function __construct()
    {
        $this->middleware('auth:merchant');
    }

    public function showConfirmForm(): Factory|View|Application
    {
        return view('merchant.auth.passwords.confirm');
    }
}
