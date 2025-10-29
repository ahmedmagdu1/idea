@extends('admin.layout.app')

@section('title', 'User Management')
@section('page-title', 'Manage Admin Users')

@section('content')
@php
    $roleLabels = [
        'administrator' => 'Administrator',
        'editor' => 'Editor',
        'viewer' => 'Viewer',
    ];

    $statusClasses = [
        'active' => 'success',
        'suspended' => 'warning',
    ];

    $currentAdminId = optional(auth()->guard('admin')->user())->id;
    $createFormDefaults = [
        'role' => old('role', 'administrator'),
        'status' => old('status', 'active'),
    ];
@endphp

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100 border-start border-4 border-primary">
            <div class="card-body">
                <h6 class="text-muted text-uppercase">Total Admins</h6>
                <h3 class="mb-0">{{ $statistics['total'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-start border-4 border-success">
            <div class="card-body">
                <h6 class="text-muted text-uppercase">Active</h6>
                <h3 class="mb-0">{{ $statistics['active'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-start border-4 border-warning">
            <div class="card-body">
                <h6 class="text-muted text-uppercase">Suspended</h6>
                <h3 class="mb-0">{{ $statistics['suspended'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form class="row g-2 align-items-center" method="GET" action="{{ route('admin.users.index') }}">
            <div class="col-md-4">
                <input
                    type="text"
                    class="form-control"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Search by name or email">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="role">
                    <option value="">Filter by role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected($filters['role'] === $role)>
                            {{ $roleLabels[$role] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">Filter by status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected($filters['status'] === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search ms-1"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Admin Users</h5>
        <button
            type="button"
            class="btn btn-success btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#createAdminModal">
            <i class="fa fa-user-plus ms-1"></i> Invite User
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $index => $admin)
                        <tr>
                            <td>{{ $admins->firstItem() + $index }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $roleLabels[$admin->role] ?? ucfirst($admin->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $statusClasses[$admin->status] ?? 'secondary' }}">
                                    {{ ucfirst($admin->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-primary me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editAdminModal{{ $admin->id }}">
                                    Edit
                                </button>
                                <form
                                    action="{{ route('admin.users.toggle-status', $admin) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-warning me-2"
                                        @if($currentAdminId === $admin->id) disabled @endif>
                                        {{ $admin->status === 'active' ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>
                                <form
                                    action="{{ route('admin.users.destroy', $admin) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to remove this admin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        @if($currentAdminId === $admin->id) disabled @endif>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No admin users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $admins->links() }}
    </div>
</div>

@foreach ($admins as $admin)
    <div
        class="modal fade"
        id="editAdminModal{{ $admin->id }}"
        tabindex="-1"
        aria-labelledby="editAdminModalLabel{{ $admin->id }}"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel{{ $admin->id }}">
                        Edit Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.users.update', $admin) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                value="{{ $admin->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ $admin->email }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" @selected($admin->role === $role)>
                                        {{ $roleLabels[$role] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($admin->status === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-muted">(Leave blank to keep current)</span></label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                minlength="8">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<div
    class="modal fade"
    id="createAdminModal"
    tabindex="-1"
    aria-labelledby="createAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAdminModalLabel">Add New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{ old('name') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            value="{{ old('email') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" @selected($createFormDefaults['role'] === $role)>
                                    {{ $roleLabels[$role] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($createFormDefaults['status'] === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            minlength="8"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Create Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
