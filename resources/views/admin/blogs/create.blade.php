@extends('admin.layout')
@php $pageTitle = 'New Post'; @endphp

@section('admin-content')

<div class="breadcrumb">
  <a href="{{ route('admin.dashboard') }}">Dashboard</a>
  <span>›</span>
  <a href="{{ route('admin.blogs.index') }}">Posts</a>
  <span>›</span>
  <span style="color:var(--charcoal);">New Post</span>
</div>

<form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="form-card">
    <div class="form-card-header">
      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--orange);"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
      <h2>Create New Blog Post</h2>
    </div>

    <div class="form-body">

      {{-- Title --}}
      <div class="form-group">
        <label class="form-label" for="title">Title <span class="req">*</span></label>
        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
          value="{{ old('title') }}" placeholder="Enter blog post title…" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-hint">A clear, descriptive title improves SEO and click-through rate.</div>
      </div>

      {{-- Short Description --}}
      <div class="form-group">
        <label class="form-label" for="short-description">Short Description <span class="req">*</span></label>
        <textarea id="short-description" name="short_description" class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
          placeholder="Brief summary shown on card listings…" rows="3" required>{{ old('short_description') }}</textarea>
        @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-hint"><span id="char-count">0</span>/300 characters recommended</div>
      </div>

      {{-- Category & Date Row --}}
      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="category">Category <span class="req">*</span></label>
          <select id="category" name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" required>
            <option value="">— Select Category —</option>
            <option value="Admit Card"  {{ old('category') === 'Admit Card'  ? 'selected' : '' }}>Admit Card</option>
            <option value="Result"      {{ old('category') === 'Result'      ? 'selected' : '' }}>Result</option>
            <option value="Latest Jobs" {{ old('category') === 'Latest Jobs' ? 'selected' : '' }}>Latest Jobs</option>
            <option value="Scheme"      {{ old('category') === 'Scheme'      ? 'selected' : '' }}>Scheme</option>
            <option value="General"     {{ old('category') === 'General'     ? 'selected' : '' }}>General</option>
            <option value="Exam Tips"   {{ old('category') === 'Exam Tips'   ? 'selected' : '' }}>Exam Tips</option>
            <option value="Answer Key"  {{ old('category') === 'Answer Key'  ? 'selected' : '' }}>Answer Key</option>
            <option value="Syllabus"    {{ old('category') === 'Syllabus'    ? 'selected' : '' }}>Syllabus</option>
          </select>
          @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="image">Featured Image</label>
          <input type="file" id="image-input" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
          @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
          <div class="form-hint">JPG, PNG, WebP — max 2MB. Recommended: 1200×630px</div>
        </div>
      </div>

      {{-- Image Preview --}}
      <div class="form-group" id="img-preview-box" style="display:none;">
        <label class="form-label">Preview</label>
        <div class="img-preview-wrap">
          <img id="img-preview" style="display:none;max-height:180px;" alt="Preview">
          <div class="img-placeholder-text">Click to upload image</div>
        </div>
      </div>

      {{-- Content --}}
      <div class="form-group">
        <label class="form-label" for="content">Full Content <span class="req">*</span></label>
        
        {{-- TINYMCE will automatically transform this textarea --}}
        <textarea id="content" name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
          rows="14" placeholder="Write the full blog post content here…">{{ old('content') }}</textarea>
        
        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-hint">Use the editor above to format your post.</div>
      </div>

    </div>

    <div class="form-footer">
      <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        Publish Post
      </button>
    </div>
  </div>

</form>

@endsection

@push('admin-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>

<script>
  tinymce.init({
    selector: '#content',
    height: 700,
    menubar: 'file edit view insert format tools table help',
    
    
    plugins: [
      'accordion', 'advlist', 'anchor', 'autolink', 'autosave', 'charmap', 'code', 
      'codesample', 'directionality', 'emoticons', 'fullscreen', 'help', 'image', 
      'importcss', 'insertdatetime', 'link', 'lists', 'media', 'nonbreaking', 
      'pagebreak', 'preview', 'quickbars', 'save', 'searchreplace', 'table', 
      'template', 'visualblocks', 'visualchars', 'wordcount'
    ],
    
    
    toolbar1: 'undo redo | restoredraft | blocks fontfamily fontsize | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat',
    toolbar2: 'pagebreak anchor codesample template | insertfile image media link | table accordion | charmap emoticons | ltr rtl | visualblocks visualchars fullscreen preview code | save print',
    
    
    font_family_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Courier New=courier new,courier; Times New Roman=times new roman,times; Verdana=verdana,geneva;',
    font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
    
    
    color_map: [
      "000000", "Black",
      "993300", "Burnt orange",
      "333300", "Dark olive",
      "003300", "Dark green",
      "003366", "Dark azure",
      "000080", "Navy Blue",
      "333399", "Indigo",
      "333333", "Very dark gray",
      "800000", "Maroon",
      "FF6600", "Orange",
      "808000", "Olive",
      "008000", "Green",
      "008080", "Teal",
      "0000FF", "Blue",
      "666699", "Grayish blue",
      "808080", "Gray",
      "FF0000", "Red",
      "FF9900", "Amber",
      "99CC00", "Yellow green",
      "339966", "Sea green",
      "33CCCC", "Turquoise",
      "3366FF", "Royal blue",
      "800080", "Purple",
      "999999", "Medium gray"
    ],
    
    
    image_advtab: true, 
    image_caption: true, 
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    nonbreaking_force_tab: true, 
    toolbar_mode: 'sliding', 
    contextmenu: 'link image table',
    
    
    templates: [
        { title: 'New Story', description: 'Basic template for a new article', content: '<h3>Starting Point</h3><p>Write your introduction here...</p>' },
        { title: 'Review Format', description: 'Structured review layout', content: '<h3>Pros</h3><ul><li></li></ul><h3>Cons</h3><ul><li></li></ul>' }
    ],

    
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    
    
    branding: false,
    promotion: false
  });
</script>>

<script>
$(function() {
  // Show preview box when file selected
  $('#image-input').on('change', function() {
    if (this.files.length) {
      $('#img-preview-box').show();
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img-preview').attr('src', e.target.result).show();
        $('.img-placeholder-text').hide();
      };
      reader.readAsDataURL(this.files[0]);
    }
  });
});
</script>
@endpush