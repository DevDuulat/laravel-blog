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
            ->take(6)
            ->get();

        $pages = Content::where('type', 'page')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        $faqs = Faq::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('home', compact('posts', 'faqs', 'pages'));

    }

    public function faqPage()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();

        return view('pages.faq', compact('faqs'));
    }


}
