<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware(['auth:user-api', 'verified']);
    }

    public function index(): JsonResponse
    {
        $user = User::find(Auth::guard('user-api')->id());
        return $this->successApiResponse($user);
    }
}
