@extends('admin.layout.app')
@section('page-title','تعديل عضو')
@section('content')
    @include('admin.team._form', ['route' => route('admin.team.update',$member), 'method' => 'PUT'])
@endsection
