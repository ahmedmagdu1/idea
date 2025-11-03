<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Career;
use App\Models\Press;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'admins_total' => Admin::count(),
            'admins_active' => Admin::where('status', 'active')->count(),
            'team_members_total' => TeamMember::count(),
            'team_members_active' => TeamMember::where('is_active', true)->count(),
            'careers_total' => Career::count(),
            'careers_published' => Career::published()->count(),
            'press_total' => Press::count(),
            'press_published' => Press::published()->count(),
        ];

        $drafts = [
            'careers' => Career::where('is_published', false)->count(),
            'press' => Press::where('is_published', false)->count(),
            'team_members_inactive' => TeamMember::where('is_active', false)->count(),
        ];

        $recentActivities = collect()
            ->merge(
                Admin::latest()->take(5)->get()->map(function (Admin $admin) {
                    return [
                        'entity' => __('admin.entity_admin'),
                        'title' => $admin->name,
                        'status' => $admin->status === 'active'
                            ? __('admin.status_active')
                            : __('admin.status_suspended'),
                        'status_class' => $admin->status === 'active' ? 'bg-success' : 'bg-warning',
                        'timestamp' => $admin->updated_at ?: $admin->created_at,
                    ];
                })
            )
            ->merge(
                Career::latest('updated_at')->latest('created_at')->take(5)->get()->map(function (Career $career) {
                    return [
                        'entity' => __('admin.entity_career'),
                        'title' => $career->title,
                        'status' => $career->is_published
                            ? __('admin.status_published')
                            : __('admin.status_draft'),
                        'status_class' => $career->is_published ? 'bg-primary' : 'bg-secondary',
                        'timestamp' => $career->updated_at ?: $career->created_at,
                    ];
                })
            )
            ->merge(
                Press::latest('updated_at')->latest('created_at')->take(5)->get()->map(function (Press $press) {
                    return [
                        'entity' => __('admin.entity_press'),
                        'title' => $press->title,
                        'status' => $press->is_published
                            ? __('admin.status_published')
                            : __('admin.status_draft'),
                        'status_class' => $press->is_published ? 'bg-info' : 'bg-secondary',
                        'timestamp' => $press->updated_at ?: $press->created_at,
                    ];
                })
            )
            ->sortByDesc('timestamp')
            ->take(10)
            ->values();

        $activityFeed = $recentActivities->take(4);

        return view('admin.dashboard', [
            'stats' => $stats,
            'drafts' => $drafts,
            'recentActivities' => $recentActivities,
            'activityFeed' => $activityFeed,
        ]);
    }

    public function settings()
    {
        $contactEmail = \App\Models\Setting::get('contact_email', '');
        $contactPhone = \App\Models\Setting::get('contact_phone', '');
        return view('admin.settings', compact('contactEmail', 'contactPhone'));
    }
}
