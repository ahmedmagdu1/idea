@extends('layouts.app')

@section('title', $item->title)

@section('content')
<div class="container py-5">
  <a href="{{ url('/press') }}" class="text-decoration-none">&larr; Back to Press</a>
  <div class="row mt-3">
    <div class="col-lg-8">
      <h1 class="mb-1">{{ $item->title }}</h1>
      <div class="text-muted mb-3">{{ optional($item->published_at)->format('M d, Y') }}</div>
      <article class="mb-4">{!! nl2br(e($item->body)) !!}</article>
    </div>
  </div>
</div>
@endsection

