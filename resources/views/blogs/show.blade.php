@extends('layouts.app')

@php
  $pageTitle = $blog->title;
  $metaDesc = $blog->short_description;
@endphp

@section('content')

<div class="page-header" style="padding:28px 24px 22px;">
  <div class="page-header-inner">
    <div class="breadcrumb style="color:#fff;"">
      <a href="/" style="color:#fff;">Home</a>
      <span style="color:rgba(255,255,255,0.7);">›</span>
      <a href="{{ route('blogs.index') }}" style="color:#fff;">Blog</a>
      <span style="color:rgba(255,255,255,0.7);">›</span>
      <span style="color:rgba(255,255,255,0.8);">{{ Str::limit($blog->title, 40) }}</span>
    </div>
  </div>
</div>

<div class="blog-detail-wrap">

  {{-- ARTICLE --}}
  <article class="blog-detail-article">

    @if($blog->image)
      <img class="blog-detail-hero" src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
    @endif

    <div class="blog-detail-content">
      <div class="blog-detail-meta">
        @php
          $badgeClass = match(strtolower($blog->category ?? '')) {
            'result'      => 'badge-result',
            'admit card'  => 'badge-admit',
            'latest jobs' => 'badge-jobs',
            'scheme'      => 'badge-scheme',
            default       => 'badge-general',
          };
        @endphp
        <span class="badge {{ $badgeClass }}">{{ $blog->category }}</span>
        <span class="blog-date">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:3px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
        </span>
      </div>

      <h1>{{ $blog->title }}</h1>

      @if($blog->short_description)
        <p style="font-size:1.05rem;color:var(--charcoal);font-weight:500;border-left:4px solid var(--orange);padding-left:16px;margin-bottom:28px;line-height:1.6;">
          {{ $blog->short_description }}
        </p>
      @endif

      <div class="prose">
        {!! $blog->content !!}
      </div>

      {{-- SHARE BAR --}}
      <div style="margin-top:36px;padding-top:24px;border-top:1px solid var(--border);display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
        <span style="font-size:0.82rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;">Share</span>
          {{-- WhatsApp --}}
          <a href="https://wa.me/?text={{ urlencode($blog->title . ' — ' . url()->current()) }}" target="_blank" class="btn btn-secondary btn-sm">
            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.859L.057 23.428a.5.5 0 00.609.61l5.692-1.463A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.808 9.808 0 01-5.032-1.388l-.36-.214-3.742.962.99-3.648-.235-.374A9.817 9.817 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
            WhatsApp
          </a>

          {{-- Twitter --}}
          <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-secondary btn-sm">
            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.261 5.632 5.903-5.632zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            Twitter
          </a>

          {{-- Copy Link --}}
          <button class="btn btn-secondary btn-sm" onclick="navigator.clipboard.writeText(window.location.href); window.showToast('Link copied!', 'success');">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            Copy Link
          </button>

      </div>
    </div>
  </article>

  {{-- SIDEBAR --}}
  <aside class="sidebar">

    {{-- Related Posts --}}
    <div class="sidebar-card">
      <div class="sidebar-card-header">
        <div class="dot"></div>
        <h3>Related Posts</h3>
      </div>
      <div class="sidebar-card-body">
        @if($relatedBlogs->count())
          <ul class="sidebar-link-list">
            @foreach($relatedBlogs as $related)
              <li>
                <a href="{{ route('blogs.show', $related->slug) }}">
                  <div>
                    <div>{{ Str::limit($related->title, 52) }}</div>
                    <div class="meta">{{ $related->created_at->format('d M Y') }}</div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        @else
          <p style="font-size:0.85rem;color:var(--muted);">No related posts found.</p>
        @endif
      </div>
    </div>

    {{-- All Categories --}}
    <div class="sidebar-card">
      <div class="sidebar-card-header">
        <div class="dot"></div>
        <h3>Browse Category</h3>
      </div>
      <div class="sidebar-card-body">
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
          @foreach($categories as $cat)
            <a href="{{ route('blogs.index') }}?category={{ urlencode($cat) }}" class="chip {{ $cat === $blog->category ? 'active' : '' }}" style="text-decoration:none;">{{ $cat }}</a>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Back Button --}}
    <a href="{{ route('blogs.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center;">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      Back to Blog
    </a>

  </aside>
</div>

@endsection