@extends('admin.layout')
@php $pageTitle = 'All Posts'; @endphp

@section('admin-content')

<div class="admin-table-card">
  <div class="admin-table-head">
    <h3>All Blog Posts <span style="font-size:0.8rem;color:var(--muted);font-weight:400;">({{ $blogs->total() }} total)</span></h3>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
      New Post
    </a>
  </div>

  {{-- Mini filter --}}
  <div style="padding:12px 20px;border-bottom:1px solid var(--border);display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
    <input type="text" id="table-search" placeholder="Search posts…" class="form-control" style="max-width:260px;padding:7px 12px;">
    <select id="table-cat" class="form-control" style="max-width:180px;padding:7px 12px;">
      <option value="">All Categories</option>
      @foreach($categories as $cat)
        <option value="{{ $cat }}">{{ $cat }}</option>
      @endforeach
    </select>
  </div>

  <div class="table-wrap">
    <table id="blogs-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Title</th>
          <th>Category</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($blogs as $blog)
          <tr data-title="{{ strtolower($blog->title) }}" data-cat="{{ $blog->category }}">
            <td style="color:var(--muted);font-size:0.8rem;">{{ $blog->id }}</td>
            <td>
              @if($blog->image)
                <img class="table-img" src="{{ asset('storage/' . $blog->image) }}" alt="">
              @else
                <div class="table-img" style="display:flex;align-items:center;justify-content:center;background:var(--light-bg);">📰</div>
              @endif
            </td>
            <td>
              <div class="table-title">{{ $blog->title }}</div>
              <div style="font-size:0.75rem;color:var(--muted);margin-top:2px;">{{ Str::limit($blog->short_description, 60) }}</div>
            </td>
            <td><span class="badge">{{ $blog->category }}</span></td>
            <td style="color:var(--muted);font-size:0.82rem;white-space:nowrap;">{{ $blog->created_at->format('d M Y') }}</td>
            <td>
              <div class="btn-group">
                <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="View">👁</a>
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
            <td colspan="6" style="text-align:center;color:var(--muted);padding:48px;">
              No posts found. <a href="{{ route('admin.blogs.create') }}" style="color:var(--orange);">Create your first post →</a>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($blogs->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">
      {{ $blogs->links() }}
    </div>
  @endif

</div>

@endsection

@push('admin-scripts')
<script>
$(function() {
  // Client-side quick filter for current page
  function filterTable() {
    var search = $('#table-search').val().toLowerCase();
    var cat    = $('#table-cat').val().toLowerCase();
    $('#blogs-table tbody tr').each(function() {
      var title = $(this).data('title') || '';
      var tcat  = ($(this).data('cat') || '').toLowerCase();
      var matchSearch = !search || title.includes(search);
      var matchCat    = !cat    || tcat === cat;
      $(this).toggle(matchSearch && matchCat);
    });
  }
  $('#table-search').on('input', filterTable);
  $('#table-cat').on('change', filterTable);
});
</script>
@endpush