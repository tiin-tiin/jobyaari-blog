@extends('admin.layout')
@php $pageTitle = 'Edit Post'; @endphp

@section('admin-content')

<div class="breadcrumb">
  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
  <span>›</span>
  <a href="{{ route('admin.blogs.index') }}">Posts</a>
  <span>›</span>
  <span style="color:var(--charcoal);">Edit: {{ Str::limit($blog->title, 40) }}</span>
</div>

<form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="form-card">
    <div class="form-card-header">
      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--orange);"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
      <h2>Edit Blog Post</h2>
      <span style="margin-left:auto;font-size:0.78rem;color:var(--muted);">ID: #{{ $blog->id }}</span>
    </div>

    <div class="form-body">

      <div class="form-group">
        <label class="form-label" for="title">Title <span class="req">*</span></label>
        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
          value="{{ old('title', $blog->title) }}" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="short-description">Short Description <span class="req">*</span></label>
        <textarea id="short-description" name="short_description" class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
          rows="3" required>{{ old('short_description', $blog->short_description) }}</textarea>
        @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-hint"><span id="char-count">{{ strlen($blog->short_description) }}</span>/300 characters</div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="category">Category <span class="req">*</span></label>
          <select id="category" name="category" class="form-control" required>
            @foreach(['Admit Card','Result','Latest Jobs','Scheme','General','Exam Tips','Answer Key','Syllabus'] as $cat)
              <option value="{{ $cat }}" {{ old('category', $blog->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
          </select>
          @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="image">Replace Image</label>
          <input type="file" id="image-input" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
          @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
          <div class="form-hint">Leave blank to keep current image.</div>
        </div>
      </div>

      {{-- Current Image --}}
      @if($blog->image)
        <div class="form-group">
          <label class="form-label">Current Image</label>
          <div style="display:flex;align-items:flex-start;gap:16px;flex-wrap:wrap;">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="Current" style="height:120px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);">
            <div>
              <p style="font-size:0.82rem;color:var(--muted);margin-bottom:10px;">Current featured image.</p>
              <label style="display:flex;align-items:center;gap:8px;font-size:0.82rem;cursor:pointer;">
                <input type="checkbox" name="remove_image" value="1"> Remove image
              </label>
            </div>
          </div>
        </div>
      @endif

      {{-- New image preview --}}
      <div class="form-group" id="img-preview-box" style="display:none;">
        <label class="form-label">New Image Preview</label>
        <img id="img-preview" style="max-height:160px;border-radius:var(--radius);border:1px solid var(--border);" alt="Preview">
      </div>

      <div class="form-group">
        <label class="form-label" for="content">Full Content <span class="req">*</span></label>
        <textarea id="content" name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
          rows="16" required>{{ old('content', $blog->content) }}</textarea>
        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      {{-- Slug info --}}
      <div style="background:var(--light-bg);border:1px solid var(--border);border-radius:var(--radius);padding:12px 16px;font-size:0.8rem;color:var(--muted);">
        <strong>Slug:</strong> /blog/{{ $blog->slug }} &nbsp;&nbsp;
        <strong>Created:</strong> {{ $blog->created_at->format('d M Y, h:i A') }} &nbsp;&nbsp;
        <strong>Updated:</strong> {{ $blog->updated_at->format('d M Y, h:i A') }}
      </div>

    </div>

    <div class="form-footer">
      <div class="btn-group">
        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="btn btn-secondary">
          👁 View Post
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
      <button type="submit" class="btn btn-primary">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        Save Changes
      </button>
    </div>
  </div>

</form>

@endsection

@push('admin-scripts')
<script>
$(function() {
  $('#image-input').on('change', function() {
    if (this.files.length) {
      $('#img-preview-box').show();
      var reader = new FileReader();
      reader.onload = function(e) { $('#img-preview').attr('src', e.target.result); };
      reader.readAsDataURL(this.files[0]);
    }
  });
});
</script>
@endpush