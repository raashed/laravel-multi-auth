<?php

namespace App\Http\Controllers\Web\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected string $redirectTo = RouteServiceProvider::USER_HOME;

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function showConfirmForm(): Factory|View|Application
    {
        return view('user.auth.passwords.confirm');
    }
}
