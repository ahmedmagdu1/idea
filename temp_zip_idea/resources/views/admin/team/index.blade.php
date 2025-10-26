@extends('admin.layout.app') {{-- افترض أن القالب الذي أرسلته محفوظ كـ layouts/admin.blade.php --}}
@section('page-title','إدارة الفريق')

@section('content')
<div class="card mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <h5 class="mb-0">أعضاء الفريق</h5>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
            <i class="fa fa-plus ms-1"></i> إضافة عضو
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>الاسم</th>
                    <th>الوظيفة</th>
                    <th>القسم</th>
                    <th>البريد</th>
                    <th>الترتيب</th>
                    <th>الحالة</th>
                    <th class="text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>
                        <img src="{{ $m->photo_url }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px">
                    </td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->title }}</td>
                    <td>{{ $m->department }}</td>
                    <td><a href="mailto:{{ $m->email }}">{{ $m->email }}</a></td>
                    <td>{{ $m->sort_order }}</td>
                    <td>
                        <span class="badge {{ $m->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $m->is_active ? 'مفعل' : 'غير مفعل' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.team.edit',$m) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                        <form action="{{ route('admin.team.destroy',$m) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('تأكيد الحذف؟');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center py-4">لا توجد بيانات حالياً</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-body">
        {{ $members->links() }}
    </div>
</div>
@endsection
س