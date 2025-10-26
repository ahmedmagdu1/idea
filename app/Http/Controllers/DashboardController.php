<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
