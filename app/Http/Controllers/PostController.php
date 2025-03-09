<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Models\Comment;
use TomatoPHP\FilamentCms\Models\Post;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['categories', 'tags'])->firstOrFail();
        $categories = Category::all();


        return view('posts.show', compact('post'));
    }
    public function incrementViews($id)
    {
        $post = Post::findOrFail($id);
        $post->increment('views');
        return response()->json(['views' => $post->views]);
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);
        $post->increment('likes');
        return response()->json(['likes' => $post->likes]);
    }
}
