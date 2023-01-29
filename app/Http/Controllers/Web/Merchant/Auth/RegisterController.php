<?php

namespace App\Http\Controllers\Web\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected string $redirectTo = RouteServiceProvider::MERCHANT_HOME;

    public function __construct()
    {
        $this->middleware('guest:merchant');
    }

    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Merchant::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm(): Factory|View|Application
    {
        return view('merchant.auth.register');
    }

    protected function guard(): Guard|StatefulGuard
    {
        return Auth::guard('merchant');
    }
}
