<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'verified']);
    }

    public function index()
    {
        return view('admin.home');
    }
}
