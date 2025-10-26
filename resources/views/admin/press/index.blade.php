@extends('admin.layout.app')

@section('title', 'Press Management')
@section('page-title', 'Press / Blog')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Press / Blog</h1>
    <a href="{{ route('admin.press.create') }}" class="btn btn-brand">New</a>
  </div>
  <table class="table table-striped">
    <thead><tr><th>Title</th><th>Status</th><th>Published</th><th></th></tr></thead>
    <tbody>
      @foreach($items as $it)
        <tr>
          <td>{{ $it->title }}</td>
          <td>{{ $it->is_published ? 'Published' : 'Draft' }}</td>
          <td>{{ optional($it->published_at)->format('Y-m-d') }}</td>
          <td class="text-end">
            <a href="{{ route('admin.press.edit', $it) }}" class="btn btn-sm btn-secondary">Edit</a>
            <form action="{{ route('admin.press.destroy', $it) }}" method="post" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $items->links() }}
  </div>
@endsection

