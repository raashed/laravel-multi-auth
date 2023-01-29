<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware(['auth:admin-api', 'verified']);
    }

    public function index(): JsonResponse
    {
        $admin = Admin::find(Auth::guard('admin-api')->id());
        return $this->successApiResponse($admin);
    }
}
