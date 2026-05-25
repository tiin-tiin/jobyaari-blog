<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — {{ $pageTitle ?? 'Dashboard' }} | JobYaari</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="admin-wrap">

  {{-- SIDEBAR --}}
  <aside class="admin-sidebar" id="admin-sidebar">
  <div class="admin-sidebar-brand" style="text-align:center;padding:28px 20px;">
    <img src="{{ asset('jobyaari_logo.png') }}" alt="JobYaari" style="height:40px;filter:brightness(0) invert(1);margin:0 auto;">
    <div class="brand-sub" style="color:rgba(255,255,255,0.8);margin-top:8px;font-size:0.75rem;letter-spacing:0.1em;">ADMIN PANEL</div>
  </div>

    <nav class="admin-nav">
      <div class="admin-nav-section">Main</div>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>

      <div class="admin-nav-section">Blog</div>
      <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        All Posts
      </a>
      <a href="{{ route('admin.blogs.create') }}" class="{{ request()->routeIs('admin.blogs.create') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        New Post
      </a>

      <div class="admin-nav-section">System</div>
      <a href="{{ route('blogs.index') }}" target="_blank">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        View Site
      </a>
      <a href="{{ route('admin.logout') }}" onclick="return confirm('Logout?')">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        Logout
      </a>
    </nav>
  </aside>

  {{-- MAIN --}}
  <main class="admin-main">

    {{-- TOP BAR --}}
    <div class="admin-topbar">
      <div style="display:flex;align-items:center;gap:12px;">
        <button id="admin-sidebar-toggle" class="btn btn-secondary btn-sm" style="display:none;">☰</button>
        <h2>{{ $pageTitle ?? 'Dashboard' }}</h2>
      </div>
      <div class="admin-user">
        <div class="admin-avatar">A</div>
        <span>Admin</span>
      </div>
    </div>

    {{-- CONTENT --}}
    <div class="admin-content">

      @if(session('success'))
        <div class="alert alert-success">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-error">⚠ {{ session('error') }}</div>
      @endif

      @yield('admin-content')
    </div>

  </main>
</div>

{{-- Delete Modal --}}
<div id="delete-modal" class="modal-overlay">
  <div class="modal-box">
    <div class="modal-icon">🗑</div>
    <h3>Delete Post?</h3>
    <p>This action cannot be undone. The post and its image will be permanently deleted.</p>
    <div class="btn-group" style="justify-content:center;">
      <button class="btn btn-secondary" id="cancel-delete">Cancel</button>
      <button class="btn btn-danger" id="confirm-delete">Yes, Delete</button>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
  // Show sidebar toggle on small screens
  if (window.innerWidth < 900) {
    document.getElementById('sidebar-toggle').style.display = 'block';
  }
</script>
@stack('admin-scripts')
</body>
</html>