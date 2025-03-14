<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $posts = Content::where('type', 'post')
            ->where('status', 'published')
            ->latest('published_at')
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Content::where('type', 'post')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
