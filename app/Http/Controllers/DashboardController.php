<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function settings()
    {
        $contactEmail = \App\Models\Setting::get('contact_email', '');
        $contactPhone = \App\Models\Setting::get('contact_phone', '');
        return view('admin.settings', compact('contactEmail', 'contactPhone'));
    }
}
