@extends('admin.layout.app')

@section('title', 'الرئيسية')
@section('page-title', 'الرئيسية')

@section('content')
<div class="row">
    <!-- إحصائيات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-white-50 mb-1">المستخدمين</h6>
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
                        <h6 class="text-white-50 mb-1">الطلبات</h6>
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
                        <h6 class="text-white-50 mb-1">المبيعات</h6>
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
                        <h6 class="text-white-50 mb-1">الزيارات</h6>
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
                <h5 class="mb-0">آخر الأنشطة</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>المستخدم</th>
                                <th>النشاط</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>أحمد محمد</td>
                                <td>تسجيل دخول جديد</td>
                                <td>منذ 5 دقائق</td>
                                <td><span class="badge bg-success">نشط</span></td>
                            </tr>
                            <tr>
                                <td>فاطمة علي</td>
                                <td>إضافة طلب جديد</td>
                                <td>منذ 15 دقيقة</td>
                                <td><span class="badge bg-primary">مكتمل</span></td>
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
                <h5 class="mb-0">إشعارات سريعة</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    لديك 3 طلبات جديدة تحتاج مراجعة
                </div>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    تذكير: النسخ الاحتياطي اليومي
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">روابط سريعة</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.content.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-pen ms-1"></i> إدارة المحتوى
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-users-gear ms-1"></i> فريق العمل
                    </a>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-dark">
                        <i class="fas fa-users ms-1"></i> المستخدمون
                    </a>
                    <a href="{{ route('admin.settings') }}" class="btn btn-outline-info">
                        <i class="fas fa-cog ms-1"></i> الإعدادات
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">آخر النشاطات</h5>
                <span class="text-muted small">تجريبي</span>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        تحديث محتوى صفحة "about"
                        <span class="badge bg-light text-dark">قبل 5 دقائق</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        إضافة عضو جديد إلى الفريق
                        <span class="badge bg-light text-dark">قبل 30 دقيقة</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
