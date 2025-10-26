@extends('admin.layout.app')

@section('title', 'الإعدادات')
@section('page-title', 'إعدادات النظام')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">الإعدادات العامة</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">اسم الموقع</label>
                        <input type="text" class="form-control" placeholder="Idea CMS">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الافتراضي للإشعارات</label>
                        <input type="email" class="form-control" placeholder="admin@idea.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">اللغة الافتراضية</label>
                        <select class="form-select">
                            <option value="ar" selected>العربية</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="maintenance">
                        <label class="form-check-label" for="maintenance">وضع الصيانة</label>
                    </div>
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-save ms-1"></i> حفظ التغييرات
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">معلومات النظام</h6>
            </div>
            <div class="card-body small text-muted">
                <div class="d-flex justify-content-between"><span>الإصدار</span><span>1.0.0</span></div>
                <div class="d-flex justify-content-between"><span>PHP</span><span>{{ PHP_VERSION }}</span></div>
                <div class="d-flex justify-content-between"><span>الإطار</span><span>Laravel</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

