<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Models\TeamMember;

// Routes الموجودة حالياً
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
});

Route::get('/portfolio', function () {
    return view('portfolio');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/', function () {
    $members = TeamMember::active()->get(); // فقط الأعضاء المفعّلين مرتّبين
    return view('welcome', compact('members'));
});

// Routes لوحة التحكم
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');



// إضافة إلى ملف routes/web.php
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    

    // Content Management System
    Route::prefix('content')->name('content.')->group(function () {
        // Main routes
        Route::get('/', [ContentManagementController::class, 'index'])->name('index');
        Route::get('/edit/{file?}', [ContentManagementController::class, 'edit'])->name('edit');
        Route::post('/update', [ContentManagementController::class, 'update'])->name('update');
        Route::post('/preview', [ContentManagementController::class, 'preview'])->name('preview');
        Route::get('preview/stream', [ContentManagementController::class, 'stream'])->name('stream');
        
        // Language management
        Route::get('/language/{locale}', [ContentManagementController::class, 'getLanguageData'])->name('language.data');
        Route::post('/language/update', [ContentManagementController::class, 'updateLanguage'])->name('language.update');
        
        // Image management
        Route::post('/image/upload', [ContentManagementController::class, 'uploadImage'])->name('image.upload');
        Route::delete('/image/delete', [ContentManagementController::class, 'deleteImage'])->name('image.delete');
    });


        // Team Management
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('/',               [TeamMemberController::class, 'index'])->name('index');
        Route::get('/create',         [TeamMemberController::class, 'create'])->name('create');
        Route::post('/',              [TeamMemberController::class, 'store'])->name('store');
        Route::get('/{team}/edit',    [TeamMemberController::class, 'edit'])->name('edit');
        Route::put('/{team}',         [TeamMemberController::class, 'update'])->name('update');
        Route::delete('/{team}',      [TeamMemberController::class, 'destroy'])->name('destroy');
    });
});
