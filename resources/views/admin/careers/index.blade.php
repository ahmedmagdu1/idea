@extends('admin.layout.app')

@section('title', 'Careers Management')
@section('page-title', 'Careers')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Careers</h1>
    <a href="{{ route('admin.careers.create') }}" class="btn btn-brand">New</a>
  </div>
  <table class="table table-striped">
    <thead><tr><th>Title</th><th>Location</th><th>Status</th><th>Published</th><th></th></tr></thead>
    <tbody>
      @foreach($items as $it)
        <tr>
          <td>{{ $it->title }}</td>
          <td>{{ $it->location }}</td>
          <td>{{ $it->is_published ? 'Published' : 'Draft' }}</td>
          <td>{{ optional($it->published_at)->format('Y-m-d') }}</td>
          <td class="text-end">
            <a href="{{ route('admin.careers.edit', $it) }}" class="btn btn-sm btn-secondary">Edit</a>
            <form action="{{ route('admin.careers.destroy', $it) }}" method="post" class="d-inline" onsubmit="return confirm('Delete?')">
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

