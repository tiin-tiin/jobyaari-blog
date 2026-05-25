@extends('admin.layout')
@php $pageTitle = 'Dashboard'; @endphp

@section('admin-content')

<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-number">{{ $totalBlogs }}</div>
    <div class="stat-label">Total Posts</div>
  </div>
  <div class="stat-card second">
    <div class="stat-number">{{ $monthBlogs }}</div>
    <div class="stat-label">This Month</div>
  </div>
  <div class="stat-card third">
    <div class="stat-number">{{ $totalCategories }}</div>
    <div class="stat-label">Categories</div>
  </div>
  <div class="stat-card fourth">
    <div class="stat-number">{{ $todayBlogs }}</div>
    <div class="stat-label">Posted Today</div>
  </div>
</div>

{{-- Recent Posts Table --}}
<div class="admin-table-card">
  <div class="admin-table-head">
    <h3>Recent Posts</h3>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm" style="background:var(--amber);border-color:var(--amber);">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
      New Post
    </a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Post</th>
          <th>Category</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentBlogs as $i => $blog)
          <tr>
            <td style="color:var(--muted);font-size:0.8rem;">{{ $i + 1 }}</td>
            <td>
              <div style="display:flex;align-items:center;gap:12px;">
                @if($blog->image)
                  <img class="table-img" src="{{ asset('storage/' . $blog->image) }}" alt="">
                @else
                  <div class="table-img" style="display:flex;align-items:center;justify-content:center;background:var(--light-bg);font-size:1.1rem;">📰</div>
                @endif
                <div class="table-title">{{ $blog->title }}</div>
              </div>
            </td>
            <td><span class="badge">{{ $blog->category }}</span></td>
            <td style="color:var(--muted);font-size:0.82rem;">{{ $blog->created_at->format('d M Y') }}</td>
            <td>
              <div class="btn-group">
                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-edit btn-sm">Edit</a>
                <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="text-align:center;color:var(--muted);padding:40px;">No posts yet. <a href="{{ route('admin.blogs.create') }}" style="color:var(--orange);">Create one →</a></td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection