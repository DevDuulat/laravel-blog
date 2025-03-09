<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{slug}', [PageController::class, 'show'])->name('post.show');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');


Route::post('/post/{id}/like', [PostController::class, 'like'])->name('post.like');
Route::post('/post/{id}/increment-views', [PostController::class, 'incrementViews'])->name('post.incrementViews');

Route::get('/frontend/home', function () {
    return view('frontend.home');
});

Route::get('/frontend/faq', function () {
    return view('frontend.faq');
});

Route::get('/frontend/login', function () {
    return view('frontend.login');
});

Route::get('/frontend/register', function () {
    return view('frontend.register');
});

Route::get('/frontend/posts', function () {
    return view('frontend.posts');
});

Route::get('/frontend/posts', function () {
    return view('frontend.post');
});

Route::get('/frontend/test', function () {
    return view('frontend.test');
});

Route::get('/frontend/categories', function () {
    return view('frontend.categories');
});

