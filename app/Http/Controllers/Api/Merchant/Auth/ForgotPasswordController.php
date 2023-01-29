<?php

namespace App\Http\Controllers\Api\Merchant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm(): Factory|View|Application
    {
        return view('merchant.auth.passwords.email');
    }

    public function broker(): PasswordBroker
    {
        return Password::broker('merchants');
    }
}
