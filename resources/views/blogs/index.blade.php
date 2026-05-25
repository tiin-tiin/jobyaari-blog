@extends('layouts.app')

@php
  $pageTitle = 'Blog';
  $metaDesc = 'Read latest articles on Sarkari Jobs, Admit Cards, Results and government exam updates.';
@endphp

@push('scripts')
<script>
  // Make filter URL available to app.js
  var blogFilterUrl = "{{ route('blogs.filter') }}";
</script>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="page-header">
  <div class="page-header-inner">
    <h1>Latest <span>Articles</span> & Updates</h1>
    <p>Stay informed with the latest Sarkari job news, admit cards, results, and exam guides.</p>
  </div>
</div>

<div class="main-wrap">
  <div class="layout-grid">

    
    {{-- SIDEBAR --}}

    <button type="button" class="btn btn-secondary sidebar-toggle-btn" id="sidebar-toggle-btn">
      Show Categories & Recent Posts
    </button>

    {{-- MAIN CONTENT --}}
    <div>

      {{-- SEARCH --}}
      <div class="search-box">
        <input type="text" id="search-input" placeholder="Search articles…" autocomplete="off">
        <span class="search-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
        </span>
      </div>

      {{-- FILTER BAR --}}
      <div class="filter-bar">
        <label>Category</label>
        <div class="filter-chips">
          <span class="chip active" data-category="all">All</span>
          @foreach($categories as $cat)
            <span class="chip" data-category="{{ $cat }}">{{ $cat }}</span>
          @endforeach
        </div>

        <div class="filter-divider"></div>

        <div class="filter-date">
          <label for="filter-date">Date</label>
          <input type="date" id="filter-date" max="{{ date('Y-m-d') }}">
          <button id="clear-date" class="btn btn-secondary btn-sm" title="Clear date">✕</button>
        </div>
      </div>

      {{-- RESULTS COUNT --}}
      <p style="font-size:0.8rem;color:var(--muted);margin-bottom:18px;">
        Showing <strong id="results-count">{{ $blogs->count() }} article{{ $blogs->count() !== 1 ? 's' : '' }}</strong>
      </p>

      {{-- BLOG GRID --}}
      <div id="blogs-container">
        @forelse($blogs as $blog)
          @include('blogs.partials.card', ['blog' => $blog])
        @empty
          <div style="text-align:center;padding:80px 24px;color:var(--muted);grid-column:1/-1;">
            <p style="font-size:2rem;margin-bottom:12px;">📭</p>
            <h3 style="font-family:var(--font-head);color:var(--charcoal);margin-bottom:6px;">No articles yet</h3>
            <p>Check back soon for the latest updates.</p>
          </div>
        @endforelse
      </div>

      {{-- No results message (shown via JS) --}}
      <div class="no-results">
        <p style="font-size:2rem;margin-bottom:12px;">🔍</p>
        <h3>No results found</h3>
        <p>Try a different category, date, or search term.</p>
      </div>

      {{-- PAGINATION --}}
      @if($blogs->hasPages())
        <div class="pagination">
          @if($blogs->onFirstPage())
            <span class="page-link" style="opacity:0.4;">‹</span>
          @else
            <a class="page-link" href="{{ $blogs->previousPageUrl() }}">‹</a>
          @endif

          @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
            <a class="page-link {{ $page == $blogs->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
          @endforeach

          @if($blogs->hasMorePages())
            <a class="page-link" href="{{ $blogs->nextPageUrl() }}">›</a>
          @else
            <span class="page-link" style="opacity:0.4;">›</span>
          @endif
        </div>
      @endif

    </div>


    <aside class="sidebar" id="sidebar-menu">

      {{-- Recent Posts --}}
      <div class="sidebar-card">
        <div class="sidebar-card-header">
          <div class="dot"></div>
          <h3>Recent Posts</h3>
        </div>
        <div class="sidebar-card-body">
          <ul class="sidebar-link-list">
            @foreach($recentBlogs as $recent)
              <li>
                <a href="{{ route('blogs.show', $recent->slug) }}">
                  <div>
                    <div>{{ Str::limit($recent->title, 50) }}</div>
                    <div class="meta">{{ $recent->created_at->format('d M Y') }} · {{ $recent->category }}</div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      {{-- Categories --}}
      <div class="sidebar-card">
        <div class="sidebar-card-header">
          <div class="dot"></div>
          <h3>Categories</h3>
        </div>
        <div class="sidebar-card-body">
          <ul class="sidebar-link-list">
            @foreach($categoryCounts as $cat => $count)
              <li>
                <a href="javascript:void(0)" onclick="$('.chip[data-category=\'{{ $cat }}\']').click(); window.scrollTo({top:0, behavior:'smooth'});">
                  <span style="flex:1;">{{ $cat }}</span>
                  <span class="badge badge-general">{{ $count }}</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

    </aside>

  </div>
  <div id="sidebar-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:1999;"></div>
</div>

@endsection