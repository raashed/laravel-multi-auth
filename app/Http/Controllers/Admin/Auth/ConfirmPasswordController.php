<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showConfirmForm()
    {
        return view('admin.auth.passwords.confirm');
    }
}
