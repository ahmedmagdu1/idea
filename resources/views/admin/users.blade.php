@extends('admin.layout.app')

@section('title', 'المستخدمون')
@section('page-title', 'إدارة المستخدمين')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="ابحث بالاسم أو البريد">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">كل الأدوار</option>
                    <option>مدير</option>
                    <option>محرر</option>
                    <option>مشاهد</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">الحالة</option>
                    <option>نشط</option>
                    <option>موقوف</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-search ms-1"></i> بحث
                </button>
            </div>
        </form>
    </div>
    </div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">قائمة المستخدمين</h5>
        <button type="button" class="btn btn-success btn-sm">
            <i class="fa fa-user-plus ms-1"></i> مستخدم جديد
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>الدور</th>
                        <th>الحالة</th>
                        <th>تحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>مشرف عام</td>
                        <td>admin@idea.com</td>
                        <td><span class="badge bg-primary">مدير</span></td>
                        <td><span class="badge bg-success">نشط</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">تعديل</button>
                            <button class="btn btn-sm btn-outline-warning">إيقاف</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

