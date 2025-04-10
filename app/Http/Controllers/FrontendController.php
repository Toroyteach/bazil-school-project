<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FrontendController extends Controller
{
    public function home()
    {
        $posts = Post::with(['author', 'files'])
            ->active()
            ->latest()
            ->paginate(3);

        return view('front.home', compact('posts'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function student()
    {
        return view('front.student');
    }

    public function blog()
    {
        $posts = Post::with(['author', 'files'])
            ->where('type', 'blog')
            ->active()
            ->latest()
            ->paginate(6);

        return view('front.blog', compact('posts'));
    }

    public function blogView($slug)
    {
        $post = Post::with(['author', 'files'])->where('slug', $slug)->firstOrFail();

        $latestPosts = Post::with('author')
            ->where('type', 'blog')
            ->active()
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('front.blog-view', compact('post', 'latestPosts'));
    }
}