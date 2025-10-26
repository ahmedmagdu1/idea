<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // التحقق من نوع المصادقة المطلوبة
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            
            // للمستخدمين العاديين (إذا كان لديك نظام مستخدمين عادي)
            return route('login'); // أو يمكنك إزالة هذا السطر إذا لم تكن تحتاجه
        }
        
        return null;
    }
}
