<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    // ── Dashboard ──────────────────────────────────────────────
    public function dashboard()
    {
        $totalBlogs      = Blog::count();
        $monthBlogs      = Blog::whereMonth('created_at', now()->month)->count();
        $todayBlogs      = Blog::whereDate('created_at', today())->count();
        $totalCategories = Blog::distinct('category')->count('category');
        $recentBlogs     = Blog::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalBlogs', 'monthBlogs', 'todayBlogs', 'totalCategories', 'recentBlogs'
        ));
    }

    // ── List all blogs ─────────────────────────────────────────
    public function index()
    {
        $blogs      = Blog::latest()->paginate(15);
        $categories = Blog::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    // ── Create form ────────────────────────────────────────────
    public function create()
    {
        return view('admin.blogs.create');
    }

    // ── Store new blog ─────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'content'           => 'required|string',
            'image'             => 'nullable|image|mimes:jpeg,png,webp,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        // Slug is auto-generated in the model boot
        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post published successfully!');
    }

    // ── Edit form ──────────────────────────────────────────────
    public function edit(int $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    // ── Update blog ────────────────────────────────────────────
    public function update(Request $request, int $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'content'           => 'required|string',
            'image'             => 'nullable|image|mimes:jpeg,png,webp,jpg|max:2048',
        ]);

        // Regenerate slug if title changed
        if ($validated['title'] !== $blog->title) {
            $validated['slug'] = Blog::generateUniqueSlug($validated['title'], $blog->id);
        }

        // Handle image remove checkbox
        if ($request->boolean('remove_image') && $blog->image) {
            Storage::disk('public')->delete($blog->image);
            $validated['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    // ── Delete blog ────────────────────────────────────────────
    public function destroy(int $id)
    {
        $blog = Blog::findOrFail($id);

        // Delete image from storage
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post deleted.');
    }
}