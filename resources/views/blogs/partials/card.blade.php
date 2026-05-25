{{-- resources/views/blogs/partials/card.blade.php --}}
@php
  $badgeClass = match(strtolower($blog->category ?? '')) {
    'result'      => 'badge-result',
    'admit card'  => 'badge-admit',
    'latest jobs' => 'badge-jobs',
    'scheme'      => 'badge-scheme',
    default       => 'badge-general',
  };
@endphp

<article class="blog-card" onclick="window.location='{{ route('blogs.show', $blog->slug) }}'" style="cursor:pointer;">
  @if($blog->image)
    <img class="blog-card-img" src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
  @else
  <div class="blog-card-img-placeholder">
  <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#CCCCCC" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
  </div>
  @endif

  <div class="blog-card-body">
    <div class="blog-card-meta">
      <span class="badge {{ $badgeClass }}">{{ $blog->category }}</span>
      <span class="blog-date">
          {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
          · {{ $blog->reading_time }}
          · {{ $blog->views ?? 0 }} views
      </span>
    </div>
    <h2>{{ $blog->title }}</h2>
    <p>{{ $blog->short_description }}</p>
  </div>

  <div class="blog-card-footer">
    <a class="btn-read" href="{{ route('blogs.show', $blog->slug) }}">
      Read More
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </a>
  </div>
</article>