<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy blog mới nhất, 3 bài / trang
        $blogs = Blog::orderBy('id', 'desc')->paginate(3);

        return view('frontend.blog.index', compact('blogs'));
    }
    public function detail($id)
    {
        $blog = Blog::findOrFail($id);

        // Blog trước
        $prevBlog = Blog::where('id', '<', $blog->id)
            ->orderBy('id', 'desc')
            ->first();

        // Blog sau
        $nextBlog = Blog::where('id', '>', $blog->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('frontend.blog.detail', compact(
            'blog',
            'prevBlog',
            'nextBlog'
        ));
    }
}
