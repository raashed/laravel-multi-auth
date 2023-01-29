<?php

namespace App\Http\Controllers\Web\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:merchant', 'verified']);
    }

    public function index(): Factory|View|Application
    {
        return view('merchant.home');
    }
}
