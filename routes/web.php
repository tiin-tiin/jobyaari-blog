<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogController;

// ── PUBLIC ROUTES ──────────────────────────────────────────────────

// Home → redirect to blog listing
Route::get('/', function () {
    return redirect()->route('blogs.index');
});

// Blog listing
Route::get('/blog', [BlogController::class, 'index'])->name('blogs.index');

// AJAX filter endpoint
Route::get('/blog/filter', [BlogController::class, 'filter'])->name('blogs.filter');

// Single blog post  (must come AFTER /blog/filter so 'filter' isn't treated as a slug)
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blogs.show');


// ── ADMIN AUTH ROUTES ──────────────────────────────────────────────

Route::get('/admin/login',  [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ── ADMIN PROTECTED ROUTES ─────────────────────────────────────────

Route::middleware(\App\Http\Middleware\AdminAuth::class)
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminBlogController::class, 'dashboard'])->name('dashboard');

        // Also redirect /admin to dashboard
        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        // Blog CRUD
        Route::get('/blogs',              [AdminBlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create',       [AdminBlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs',             [AdminBlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{id}/edit',    [AdminBlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{id}',         [AdminBlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{id}',      [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
    });