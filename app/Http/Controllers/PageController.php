<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Models\Post;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Post::where('slug', $slug)->firstOrFail();
        return view('pages.show', compact('page'));
    }
}
