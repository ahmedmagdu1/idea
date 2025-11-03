@extends('admin.layout.app')

@section('title', __('admin.home'))
@section('page-title', __('admin.home'))

@section('content')
<div class="row">
    <!-- إحصائيات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.admin_accounts') }}</h6>
                        <h3 class="mb-1">{{ number_format($stats['admins_total'] ?? 0) }}</h3>
                        <p class="text-white-50 mb-0 small">
                            {{ __('admin.admins_active_short', ['count' => number_format($stats['admins_active'] ?? 0)]) }}
                        </p>
                    </div>
                    <i class="fas fa-users fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.team_members_label') }}</h6>
                        <h3 class="mb-1">{{ number_format($stats['team_members_active'] ?? 0) }}</h3>
                        <p class="text-white-50 mb-0 small">
                            {{ __('admin.team_members_active_short', [
                                'active' => number_format($stats['team_members_active'] ?? 0),
                                'total' => number_format($stats['team_members_total'] ?? 0),
                            ]) }}
                        </p>
                    </div>
                    <i class="fas fa-user-check fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.careers_published_label') }}</h6>
                        <h3 class="mb-1">{{ number_format($stats['careers_published'] ?? 0) }}</h3>
                        <p class="text-white-50 mb-0 small">
                            {{ __('admin.careers_total_short', ['count' => number_format($stats['careers_total'] ?? 0)]) }}
                        </p>
                    </div>
                    <i class="fas fa-briefcase fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.press_published_label') }}</h6>
                        <h3 class="mb-1">{{ number_format($stats['press_published'] ?? 0) }}</h3>
                        <p class="text-white-50 mb-0 small">
                            {{ __('admin.press_total_short', ['count' => number_format($stats['press_total'] ?? 0)]) }}
                        </p>
                    </div>
                    <i class="fas fa-newspaper fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('admin.recent_activities') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('admin.entity') }}</th>
                                <th>{{ __('admin.details') }}</th>
                                <th>{{ __('admin.last_update') }}</th>
                                <th>{{ __('admin.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentActivities as $activity)
                                <tr>
                                    <td>{{ $activity['entity'] }}</td>
                                    <td>{{ $activity['title'] }}</td>
                                    <td>{{ optional($activity['timestamp'])->diffForHumans() ?: __('admin.not_available') }}</td>
                                    <td>
                                        <span class="badge {{ $activity['status_class'] ?? 'bg-secondary' }}">
                                            {{ $activity['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">{{ __('admin.no_recent_activity') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('admin.quick_notifications') }}</h5>
            </div>
            <div class="card-body">
                @php
                    $hasAlerts = ($drafts['careers'] ?? 0) || ($drafts['press'] ?? 0) || ($drafts['team_members_inactive'] ?? 0);
                @endphp
                @if ($hasAlerts)
                    @if (!empty($drafts['careers']))
                        <div class="alert alert-warning">
                            <i class="fas fa-briefcase me-2"></i>
                            {{ trans_choice('admin.pending_careers', $drafts['careers'], ['count' => number_format($drafts['careers'])]) }}
                        </div>
                    @endif
                    @if (!empty($drafts['press']))
                        <div class="alert alert-info">
                            <i class="fas fa-newspaper me-2"></i>
                            {{ trans_choice('admin.pending_press', $drafts['press'], ['count' => number_format($drafts['press'])]) }}
                        </div>
                    @endif
                    @if (!empty($drafts['team_members_inactive']))
                        <div class="alert alert-secondary">
                            <i class="fas fa-user-clock me-2"></i>
                            {{ trans_choice('admin.inactive_team_members', $drafts['team_members_inactive'], ['count' => number_format($drafts['team_members_inactive'])]) }}
                        </div>
                    @endif
                @else
                    <div class="alert alert-success mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ __('admin.no_pending_notifications') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('admin.quick_links') }}</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.content.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-pen ms-1"></i> {{ __('admin.manage_content') }}
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-users-gear ms-1"></i> {{ __('admin.team') }}
                    </a>
                    <a href="{{ route('admin.press.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-newspaper ms-1"></i> {{ __('admin.manage_press_blog') }}
                    </a>
                    <a href="{{ route('admin.press.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus ms-1"></i> {{ __('admin.new_press_post') }}
                    </a>
                    <a href="{{ route('admin.careers.index') }}" class="btn btn-outline-info">
                        <i class="fas fa-briefcase ms-1"></i> {{ __('admin.manage_careers') }}
                    </a>
                    <a href="{{ route('admin.careers.create') }}" class="btn btn-outline-info">
                        <i class="fas fa-plus ms-1"></i> {{ __('admin.new_career') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark">
                        <i class="fas fa-users ms-1"></i> {{ __('admin.users') }}
                    </a>
                    <a href="{{ route('admin.settings') }}" class="btn btn-outline-info">
                        <i class="fas fa-cog ms-1"></i> {{ __('admin.settings') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('admin.recent_activity') }}</h5>
                <span class="text-muted small">{{ __('admin.experimental') }}</span>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($activityFeed as $activity)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-3">
                                <div class="fw-semibold">{{ $activity['title'] }}</div>
                                <div class="text-muted small">
                                    {{ $activity['entity'] }}
                                    &middot;
                                    {{ optional($activity['timestamp'])->diffForHumans() ?: __('admin.not_available') }}
                                </div>
                            </div>
                            <span class="badge {{ $activity['status_class'] ?? 'bg-secondary' }}">
                                {{ $activity['status'] }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">{{ __('admin.no_recent_activity') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
