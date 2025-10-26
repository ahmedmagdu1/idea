@extends('admin.layout.app')

@section('title', 'Careers Management')
@section('page-title', $item->exists ? 'Edit Career' : 'New Career')

@section('content')
<div class="container py-4">
  <h1 class="h4 mb-3">{{ $item->exists ? 'Edit Career' : 'New Career' }}</h1>
  <form method="post" action="{{ $item->exists ? route('admin.careers.update', $item) : route('admin.careers.store') }}" enctype="multipart/form-data">
    @csrf
    @if($item->exists) @method('PUT') @endif
    <div class="row g-3">
      <div class="col-md-8">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Slug</label>
        <input name="slug" class="form-control" value="{{ old('slug', $item->slug) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Location</label>
        <input name="location" class="form-control" value="{{ old('location', $item->location) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Type</label>
        <input name="type" class="form-control" value="{{ old('type', $item->type) }}" placeholder="Full-time / Part-time">
      </div>
      <div class="col-md-4">
        <label class="form-label">Published at</label>
        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($item->published_at)->format('Y-m-d\TH:i')) }}">
      </div>
      <div class="col-12">
        <label class="form-label">Excerpt</label>
        <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>
      </div>
      <div class="col-12">
        <label class="form-label">Body</label>
        <textarea name="body" class="form-control" rows="8">{{ old('body', $item->body) }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
        @if($item->image)
          <div class="mt-2">
            <img src="/{{ $item->image }}" alt="Image" style="max-height:120px" class="img-thumbnail">
          </div>
        @endif
      </div>
      <div class="col-12 form-check mt-2">
        <input type="checkbox" name="is_published" value="1" class="form-check-input" id="is_pub" {{ old('is_published', $item->is_published) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_pub">Published</label>
      </div>
      <div class="col-12 mt-3">
        <button class="btn btn-brand">Save</button>
        <a href="{{ route('admin.careers.index') }}" class="btn btn-link">Cancel</a>
      </div>
    </div>
  </form>
  </div>
@endsection
