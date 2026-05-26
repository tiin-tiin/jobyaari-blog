console.log("app.js is successfully loaded!");
   $(function () {

    //NAVBAR TOGGLE (mobile)
    $('.navbar-toggle').on('click', function () {
      $('.navbar-nav').toggleClass('open');
      $(this).toggleClass('active');
    });
  
    //BACK TO TOP
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 300) {
        $('.back-top').addClass('show');
      } else {
        $('.back-top').removeClass('show');
      }
    });
  
    $('.back-top').on('click', function () {
      $('html, body').animate({ scrollTop: 0 }, 400);
    });
  
    //AJAX FILTER ENGINE
    if ($('#blogs-container').length) {
      var filterTimer;
      var activeCategory = 'all';
      var activeDate = '';
      var activeSearch = '';
  
      // Category chip click
      $(document).on('click', '.chip[data-category]', function () {
        $('.chip[data-category]').removeClass('active');
        $(this).addClass('active');
        activeCategory = $(this).data('category');
        runFilter();

        
        if ($('#sidebar-menu').hasClass('open')) {
            $('#sidebar-menu').removeClass('open');
            $('#sidebar-overlay').fadeOut(200);
            $('body').css('overflow', ''); 
            $('#sidebar-toggle-btn').text('Show Categories & Recent Posts');
        }
      });
  
      // Date filter
      $('#filter-date').on('change', function () {
        activeDate = $(this).val();
        runFilter();
      });
  
      // Date clear
      $('#clear-date').on('click', function () {
        $('#filter-date').val('');
        activeDate = '';
        runFilter();
      });
  
      // Search input 
      $('#search-input').on('input', function () {
        clearTimeout(filterTimer);
        activeSearch = $(this).val().trim();
        filterTimer = setTimeout(runFilter, 400);
      });
  
      function runFilter() {
        showLoading();
        $.ajax({
          url: blogFilterUrl,
          method: 'GET',
          data: {
            category: activeCategory,
            date: activeDate,
            search: activeSearch
          },
          success: function (res) {
            hideLoading();
            if (res.html && res.html.trim() !== '') {
              $('#blogs-container').html(res.html);
              $('.no-results').hide();
            } else {
              $('#blogs-container').html('');
              $('.no-results').show();
            }
            if (typeof res.count !== 'undefined') {
              $('#results-count').text(res.count + ' article' + (res.count !== 1 ? 's' : ''));
            }
          },
          error: function () {
            hideLoading();
            showToast('Something went wrong. Please try again.', 'error');
          }
        });
      }
  
      function showLoading() {
        $('#blogs-container').html('<div class="loading-spinner" style="display:block;"><div class="spinner"></div><p style="color:var(--muted);font-size:0.85rem;">Loading posts…</p></div>');
        $('.no-results').hide();
      }
  
      function hideLoading() {}
    }
  
    //IMAGE PREVIEW
    $('#image-input').on('change', function () {
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#img-preview').attr('src', e.target.result).show();
          $('.img-placeholder-text').hide();
        };
        reader.readAsDataURL(file);
      }
    });

    // SIDEBAR TOGGLE 
    $(document).on('click', '#sidebar-toggle-btn', function(e) {
      e.preventDefault();
      console.log("clicked")
      
      var $menu = $('#sidebar-menu');
      var $overlay = $('#sidebar-overlay');
      var $btn = $(this);

      // Toggle classes and visibility
      $menu.toggleClass('open');
      $overlay.fadeToggle(200);
      
      // Toggle body scroll
      $('body').css('overflow', $menu.hasClass('open') ? 'hidden' : '');
      
      // Toggle Button Text
      $btn.text($menu.hasClass('open') 
          ? 'Hide Categories & Recent Posts' 
          : 'Show Categories & Recent Posts');
  });

    // SIDEBAR OVERLAY CLOSE 
    $(document).on('click', '#sidebar-overlay', function() {
        $('#sidebar-menu').removeClass('open');
        $('#sidebar-overlay').fadeOut(200);
        $('body').css('overflow', '');
        $('#sidebar-toggle-btn').text('Show Categories & Recent Posts');
    });
    
  
    //ADMIN DELETE CONFIRM
    $(document).on('click', '.delete-btn', function (e) {
      e.preventDefault();
      var form = $(this).closest('form');
      $('#delete-modal').addClass('show');
      $('#confirm-delete').off('click').on('click', function () {
        form.submit();
      });
    });
  
    $('#cancel-delete, #delete-modal').on('click', function (e) {
      if (e.target === this) {
        $('#delete-modal').removeClass('show');
      }
    });
  
    //ADMIN SIDEBAR
    $('#admin-sidebar-toggle').on('click', function () {
      $('.admin-sidebar').toggleClass('open');
    });
  
    //TOAST NOTIFICATION
    window.showToast = function (msg, type) {
      var cls = type === 'error' ? 'alert-error' : 'alert-success';
      var toast = $('<div class="alert ' + cls + '" style="position:fixed;bottom:24px;left:50%;transform:translateX(-50%);z-index:9999;min-width:280px;text-align:center;animation:fadeUp 0.3s ease;">' + msg + '</div>');
      $('body').append(toast);
      setTimeout(function () { toast.fadeOut(300, function () { $(this).remove(); }); }, 3000);
    };
  
    //AUTO-DISMISS ALERTS
    setTimeout(function () {
      $('.alert-success, .alert-error').fadeOut(500);
    }, 4000);
  
    //CHAR COUNT FOR EXCERPT
    $('#short-description').on('input', function () {
      var len = $(this).val().length;
      $('#char-count').text(len);
      if (len > 300) {
        $('#char-count').css('color', 'var(--danger)');
      } else {
        $('#char-count').css('color', 'var(--muted)');
      }
    });
  
  });