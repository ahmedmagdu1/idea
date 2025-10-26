@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
</div>
@endif

<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">الاسم *</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $member->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">المسمى الوظيفي</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $member->title) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">القسم</label>
                <input type="text" name="department" class="form-control"
                       value="{{ old('department', $member->department) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $member->email) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">الهاتف</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ old('phone', $member->phone) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">LinkedIn</label>
                <input type="url" name="linkedin_url" class="form-control"
                       placeholder="https://www.linkedin.com/in/username"
                       value="{{ old('linkedin_url', $member->linkedin_url) }}">
            </div>
            <div class="col-12">
                <label class="form-label">نبذة/وصف</label>
                <textarea name="bio" rows="4" class="form-control">{{ old('bio', $member->bio) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">صورة العضو (jpg/png/webp, 2MB)</label>
                <input type="file" name="photo" accept="image/*" class="form-control"
                       onchange="previewTeamPhoto(this)">
                <div class="mt-2">
                    <img id="photoPreview" src="{{ $member->photo_url ?? asset('images/team/placeholder.png') }}"
                         style="max-width:140px;height:140px;object-fit:cover;border-radius:12px;border:1px solid #eee">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label">ترتيب العرض</label>
                <input type="number" name="sort_order" class="form-control"
                       value="{{ old('sort_order', $member->sort_order ?? 0) }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                           name="is_active" {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">مفعل</label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">رجوع</a>
        <button class="btn btn-primary">حفظ</button>
    </div>
</form>

@push('scripts')
<script>
function previewTeamPhoto(input){
    const img = document.getElementById('photoPreview');
    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
    }
}
</script>
@endpush
