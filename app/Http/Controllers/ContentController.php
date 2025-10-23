<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $locale = app()->getLocale();

        $post = Content::where('type', 'post')
            ->where('status', 'published')
            ->where(function ($query) use ($slug) {
                $query->where('slug->ru', $slug)
                    ->orWhere('slug->kg', $slug);
            })
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }


    public function pagesIndex()
    {
        $categoryIds = Category::where('category_type', 'page')->pluck('id');

        $pages = Content::whereIn('category_id', $categoryIds)
            ->where('type', 'page')
            ->where('status', 'published')
            ->latest('published_at')
            ->get();

        return view('pages.index', compact('pages'));
    }

    public function showPage($slug)
    {
        $locale = app()->getLocale();

        $page = Content::where('type', 'page')
            ->where('status', 'published')
            ->where(function ($query) use ($slug) {
                $query->where('slug->ru', $slug)
                    ->orWhere('slug->kg', $slug);
            })
            ->firstOrFail();

        return view('pages.show', compact('page'));
    }


    public function trafficSigns()
    {
        $locale = app()->getLocale();

        $slugMap = [
            'ru' => 'dorozhnye-znaki',
            'kg' => 'zol-belgileri',
        ];

        $categorySlug = $slugMap[$locale] ?? 'dorozhnye-znaki';

        $category = Cache::remember("traffic.category.$locale", 3600, function () use ($locale, $categorySlug) {
            return Category::where("slug->{$locale}", $categorySlug)->firstOrFail();
        });

        $subcategories = Cache::remember("traffic.subcategories.$locale", 3600, function () use ($category) {
            return Category::where('parent_id', $category->id)->get();
        });

        $contents = Cache::remember("traffic.contents.$locale", 3600, function () use ($subcategories) {
            return Content::whereIn('category_id', $subcategories->pluck('id')->toArray())
                ->where('type', 'page')
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        });

        return view('pages.pdd-section', compact('contents', 'subcategories'));
    }




    public function roadMarkings()
    {
        $locale = app()->getLocale();

        $slugMap = [
            'ru' => 'doroznaia-razmetka',
            'kg' => 'zol-syzyktary',
        ];

        $categorySlug = $slugMap[$locale] ?? 'doroznaia-razmetka';

        $category = Category::where("slug->{$locale}", $categorySlug)->firstOrFail();

        $subcategories = Category::where('parent_id', $category->id)->get();

        $contents = Content::whereIn('category_id', $subcategories->pluck('id')->toArray())
            ->where('type', 'page')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('pages.pdd-section', compact('contents', 'subcategories'));
    }

    public function fines()
    {
        $locale = app()->getLocale();

        $category = Category::whereJsonContains("slug->$locale", 'fines')->firstOrFail();

        $pages = Content::where('category_id', $category->id)
            ->where('type', 'page')
            ->where('status', 'published')
            ->latest('published_at')
            ->get();

        return view('pages.index', compact('pages'));
    }






}
