# JobYaari Blog Management System

A full-stack Blog Management System built for the JobYaari Developer Assessment. Features a public blog listing page with AJAX filtering and a complete admin panel for managing blog posts.

**Live Demo:** https://jobyaari-blog-production-a9eb.up.railway.app/blog
**Admin Panel:** https://jobyaari-blog-production-a9eb.up.railway.app/admin 

---

## Features

### Public Side
- Blog listing page with all posts fetched dynamically from the database
- Each blog card shows title, image, short description, category badge, date, reading time, and view count
- Full blog detail page with image, content, and share buttons (WhatsApp, Twitter, Copy Link)
- **AJAX + jQuery filtering**: filter by category and date with no page reload
- **Live search**: search by title or description instantly (debounced 400ms)
- View count: increments every time a blog post is opened
- Reading time: automatically calculated from content word count
- Responsive design: works on both mobile and desktop
- Mobile slide-in sidebar with recent posts and categories
- Click overlay to close sidebar on mobile
- Back to top button

### Admin Panel
- Secure admin login system (session-based)
- Dashboard with stats: total posts, this month, categories, posted today
- **Add** new blog posts with title, content, category, short description, and image upload
- **Edit** existing blog posts with image replace/remove option
- **Delete** blog posts with confirmation modal
- Image preview before upload
- Auto-generated slugs from post titles
- Character count on short description field

---

## Tech Stack

- **Backend:** PHP 8.x / Laravel 13
- **Database:** MySQL
- **Frontend:** HTML5, CSS3 (fully custom, no framework)
- **Font:** Plus Jakarta Sans (Google Fonts)
- **JavaScript:** jQuery 3.7 + AJAX (no page reload filtering)
- **Image Storage:** Laravel Storage (public disk)
- **Version Control:** Git + GitHub

---

## Setup Steps

### Requirements
- PHP 8.1+
- Composer
- MySQL
- Git

### Installation

**1. Clone the repository**
```bash
git clone https://github.com/your-username/jobyaari-blog.git
cd jobyaari-blog
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Create environment file**
```bash
cp .env.example .env
```

**4. Configure `.env`**
```env
APP_NAME=JobYaari
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jobyaari_db
DB_USERNAME=root
DB_PASSWORD=your_password


FILESYSTEM_DISK=public
```

**5. Generate app key**
```bash
php artisan key:generate
```

**6. Run migrations**
```bash
php artisan migrate
```

**7. Create storage symlink**
```bash
php artisan storage:link
```

**8. Seed sample blog posts (optional)**
```bash
php artisan db:seed --class=BlogSeeder
```

**9. Start the server**
```bash
php artisan serve
```

**10. Visit the app**
- Blog: http://localhost:8000/blog
- Admin: http://localhost:8000/admin/login

---

## Admin Access

Default credentials are set in `app/Http/Controllers/Admin/AdminAuthController.php`.
You can change them there or set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in your `.env` file.

---

## Project Structure

```
jobyaari-blog/
├── app/
│   ├── Http/Controllers/
│   │   ├── BlogController.php          # Public blog + AJAX filter endpoint
│   │   └── Admin/
│   │       ├── AdminAuthController.php # Login/logout
│   │       └── AdminBlogController.php # Blog CRUD + dashboard
│   ├── Models/Blog.php                 # Blog model with slug + reading time
│   └── Http/Middleware/AdminAuth.php   # Admin session guard
├── resources/views/
│   ├── layouts/app.blade.php           # Main public layout
│   ├── blogs/
│   │   ├── index.blade.php             # Blog listing with AJAX filters
│   │   ├── show.blade.php              # Blog detail page
│   │   └── partials/card.blade.php     # Blog card partial (used in AJAX)
│   └── admin/
│       ├── layout.blade.php            # Admin layout with sidebar
│       ├── login.blade.php             # Admin login page
│       ├── dashboard.blade.php         # Admin dashboard
│       └── blogs/
│           ├── index.blade.php         # All posts table
│           ├── create.blade.php        # New post form
│           └── edit.blade.php          # Edit post form
├── public/
│   ├── css/style.css                   # All styles (no framework)
│   └── js/app.js                       # AJAX + jQuery interactions
└── routes/web.php                      # All public and admin routes
```

---

## AJAX Filter Implementation

The filter works without any page reload:

1. User clicks a category chip or picks a date
2. jQuery sends a GET request to `/blog/filter` with filter params
3. Laravel queries the DB and renders blog card partials
4. Response returns `{ html, count }` as JSON
5. jQuery replaces `#blogs-container` content instantly

