@extends('admin.layout.app')

@section('title', __('admin.home'))
@section('page-title', __('admin.home'))

@section('content')
<div class="row">
    <!-- إحصائيات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.users') }}</h6>
                        <h3 class="mb-0">1,234</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.requests') }}</h6>
                        <h3 class="mb-0">856</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-shopping-cart fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.sales') }}</h6>
                        <h3 class="mb-0">$24,500</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-dollar-sign fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-white-50 mb-1">{{ __('admin.visits') }}</h6>
                        <h3 class="mb-0">12,456</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-eye fa-2x opacity-75"></i>
                    </div>
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
                                <th>{{ __('admin.user') }}</th>
                                <th>{{ __('admin.activity') }}</th>
                                <th>{{ __('admin.date') }}</th>
                                <th>{{ __('admin.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>أحمد محمد</td>
                                <td>تسجيل دخول جديد</td>
                                <td>منذ 5 دقائق</td>
                                <td><span class="badge bg-success">{{ __('admin.active') }}</span></td>
                            </tr>
                            <tr>
                                <td>فاطمة علي</td>
                                <td>إضافة طلب جديد</td>
                                <td>منذ 15 دقيقة</td>
                                <td><span class="badge bg-primary">{{ __('admin.completed') }}</span></td>
                            </tr>
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
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ __('admin.new_requests_pending') }}
                </div>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ __('admin.backup_reminder') }}
                </div>
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
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-dark">
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
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('admin.content_update') }}
                        <span class="badge bg-light text-dark">{{ __('admin.minutes_ago', ['count' => 5]) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('admin.team_member_added') }}
                        <span class="badge bg-light text-dark">{{ __('admin.minutes_ago', ['count' => 30]) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
