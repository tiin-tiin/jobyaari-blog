<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $metaDesc ?? 'Latest Sarkari Jobs, Admit Cards, Results & Updates — JobYaari Blog' }}">
  <title>{{ $pageTitle ?? 'Blog' }} | JobYaari</title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  {{-- NAVBAR --}}
  <nav class="navbar">
    <div class="navbar-inner">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('jobyaari_logo.png') }}" alt="JobYaari" style="height:38px;">
      </a>

      <ul class="navbar-nav" id="main-nav">
        <li class="nav-close-btn" style="display:none;">
            <button onclick="$('.navbar-nav').removeClass('open');" style="background:none;border:none;font-size:1.4rem;cursor:pointer;color:var(--charcoal);padding:4px 8px;">✕</button>
        </li>

        <li><a href="/" {{ request()->is('/') ? 'class=active' : '' }}>Home</a></li>
        <li><a href="/blog" {{ request()->is('blog*') ? 'class=active' : '' }}>Blogs</a></li>

        
        <li><a href="/blog">Admit Card</a></li>
        <li><a href="/blog">Result</a></li>
        <li><a href="/blog">Latest Jobs</a></li>
        
        <li><a href="/admin/login" class="nav-admin">Admin</a></li>
      </ul>

      <div class="navbar-toggle" id="nav-toggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </div>
    </div>
  </nav>

  {{-- FLASH MESSAGES --}}
  @if(session('success'))
    <div class="alert alert-success" style="max-width:800px;margin:16px auto;border-radius:var(--radius-sm);">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-error" style="max-width:800px;margin:16px auto;border-radius:var(--radius-sm);">
      ⚠ {{ session('error') }}
    </div>
  @endif

  @yield('content')

  {{-- FOOTER --}}
  <footer style="color: #ffffff;">
    <p style="color: #ffffff;">
      © {{ date('Y') }} 
      <a href="{{ url('/blog') }}" style="color: #ffffff; text-decoration: underline;">JobYaari.com</a> 
      — All Rights Reserved &nbsp;|&nbsp; Blog Management System
    </p>
  </footer>

  {{-- BACK TO TOP --}}
  <div class="back-top" title="Back to top">
    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
  </div>

  {{-- DELETE MODAL --}}
  <div id="delete-modal" class="modal-overlay">
    <div class="modal-box">
      <div class="modal-icon">🗑</div>
      <h3>Delete Post?</h3>
      <p>This action cannot be undone. The blog post will be permanently removed.</p>
      <div class="btn-group" style="justify-content:center;">
        <button class="btn btn-secondary" id="cancel-delete">Cancel</button>
        <button class="btn btn-danger" id="confirm-delete">Yes, Delete</button>
      </div>
    </div>
  </div>

  {{-- SCRIPTS --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  @stack('scripts')
</body>
</html>