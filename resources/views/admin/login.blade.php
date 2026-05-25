<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — JobYaari</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="login-page">
  <div class="login-card">

    <div class="login-header">
      <div class="brand">JOB<span style="color:#FFB800;">YAARI</span></div>
      <p>Blog Admin Panel</p>
    </div>

    <div class="login-body">
      @if(session('error'))
        <div class="alert alert-error" style="margin-bottom:20px;">
          ⚠ {{ session('error') }}
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
            value="{{ old('email') }}"
            placeholder="admin@jobyaari.com"
            required
            autofocus
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
            placeholder="Enter password"
            required
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px 20px;font-size:0.95rem;margin-top:8px;">
          Sign In to Admin
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
      </form>

      <p style="text-align:center;margin-top:20px;font-size:0.8rem;color:var(--muted);">
        <a href="{{ route('blogs.index') }}" style="color:var(--orange);">← Back to website</a>
      </p>
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>