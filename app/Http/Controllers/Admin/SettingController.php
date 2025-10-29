<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
        ]);

        if (array_key_exists('contact_email', $validated)) {
            Setting::set('contact_email', $validated['contact_email'] ?? '');
        }
        if (array_key_exists('contact_phone', $validated)) {
            Setting::set('contact_phone', $validated['contact_phone'] ?? '');
        }

        return redirect()->back()->with('status', __('Saved successfully.'));
    }
}

