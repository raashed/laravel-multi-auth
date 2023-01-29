<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\ApiResponseTrait;
use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorApiResponse($validator->errors());
        }

        if ($this->guard()->attempt($this->credentials($request), $request->boolean('remember'))) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $this->limiter()->clear($this->throttleKey($request));

            $token = Admin::find($this->guard()->id())->createToken(Str::random(40))->accessToken;

            return $this->successApiResponse($token);
        }

        return $this->validationErrorApiResponse([
            "email" => [
                "Invalid email or password."
            ]
        ]);
    }

    protected function guard(): Guard|StatefulGuard
    {
        return Auth::guard('admin');
    }

    protected function credentials(Request $request): array
    {
        return $request->only('email', 'password');
    }

    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->successApiResponse('Logout successfully');
    }
}
