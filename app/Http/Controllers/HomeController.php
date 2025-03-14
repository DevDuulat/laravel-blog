<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Content::where('type', 'post')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        $faqs = Faq::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('home', compact('posts', 'faqs'));

    }
}
