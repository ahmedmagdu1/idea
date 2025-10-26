@extends('admin.layout.app') {{-- افترض أن القالب الذي أرسلته محفوظ كـ layouts/admin.blade.php --}}
@section('page-title','إضافة عضو')
@section('content')
    @include('admin.team._form', ['route' => route('admin.team.store'), 'method' => 'POST'])
@endsection
