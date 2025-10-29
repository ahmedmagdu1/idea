<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    private const ROLES = ['administrator', 'editor', 'viewer'];
    private const STATUSES = ['active', 'suspended'];

    public function index(Request $request)
    {
        $filters = [
            'search' => trim((string) $request->input('search')),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
        ];

        $adminsQuery = Admin::query()->orderBy('name');

        if ($filters['search'] !== '') {
            $searchTerm = '%' . $filters['search'] . '%';
            $adminsQuery->where(function ($query) use ($searchTerm) {
                $query
                    ->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }

        if (!empty($filters['role']) && in_array($filters['role'], self::ROLES, true)) {
            $adminsQuery->where('role', $filters['role']);
        }

        if (!empty($filters['status']) && in_array($filters['status'], self::STATUSES, true)) {
            $adminsQuery->where('status', $filters['status']);
        }

        $admins = $adminsQuery->paginate(10)->withQueryString();

        $statistics = [
            'total' => Admin::count(),
            'active' => Admin::where('status', 'active')->count(),
            'suspended' => Admin::where('status', 'suspended')->count(),
        ];

        return view('admin.users', [
            'admins' => $admins,
            'filters' => $filters,
            'roles' => self::ROLES,
            'statuses' => self::STATUSES,
            'statistics' => $statistics,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'role' => ['required', Rule::in(self::ROLES)],
            'status' => ['required', Rule::in(self::STATUSES)],
            'password' => ['required', 'string', 'min:8'],
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin user created successfully.');
    }

    public function update(Request $request, Admin $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($user->id),
            ],
            'role' => ['required', Rule::in(self::ROLES)],
            'status' => ['required', Rule::in(self::STATUSES)],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $updates = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $updates['password'] = Hash::make($validated['password']);
        }

        $user->update($updates);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin user updated successfully.');
    }

    public function destroy(Request $request, Admin $user)
    {
        $currentAdmin = $request->user('admin');

        if ($currentAdmin && $currentAdmin->is($user)) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin user removed successfully.');
    }

    public function toggleStatus(Request $request, Admin $user)
    {
        $currentAdmin = $request->user('admin');

        if ($currentAdmin && $currentAdmin->is($user)) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot change your own status.');
        }

        $user->update([
            'status' => $user->status === 'active' ? 'suspended' : 'active',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin user status updated.');
    }
}

