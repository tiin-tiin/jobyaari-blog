<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //Blog listing page
    public function index(Request $request)
    {
        
        $blogs = Blog::latest()
            ->byCategory($request->category ?? 'all')
            ->byDate($request->date ?? '')
            ->search($request->search ?? '')
            ->paginate(9)
            ->withQueryString();

        $categories     = Blog::select('category')->distinct()->orderBy('category')->pluck('category');
        $recentBlogs   = Blog::latest()->take(5)->get(); 
        $categoryCounts = Blog::select('category')
            ->selectRaw('count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('blogs.index', compact(
            'blogs', 'categories', 'recentBlogs', 'categoryCounts'
        ));
    }

    // AJAX filter endpoint 
    public function filter(Request $request)
    {
        $category = $request->input('category', 'all');
        $date     = $request->input('date', '');
        $search   = $request->input('search', '');

        
        $blogs = Blog::latest()
            ->byCategory($category)
            ->byDate($date)
            ->search($search)
            ->get();

        $html = '';
        foreach ($blogs as $blog) {
            $html .= view('blogs.partials.card', compact('blog'))->render();
        }

        return response()->json([
            'html'  => $html,
            'count' => $blogs->count(),
        ]);
    }

    //Single blog post 
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $relatedBlogs = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest() 
            ->take(5)
            ->get();

        $categories = Blog::select('category')->distinct()->orderBy('category')->pluck('category');
        $blog->increment('views');

        return view('blogs.show', compact('blog', 'relatedBlogs', 'categories'));
    }
}