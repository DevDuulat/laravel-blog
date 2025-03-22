<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SavedQuestionController;
use App\Http\Controllers\TestController;
use App\Livewire\CategoryTests;
use App\Models\Test;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts', [ContentController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [ContentController::class, 'show'])->name('posts.show');

Route::get('/categories', [TestController::class, 'index'])->name('categories');

Route::get('/tests', [TestController::class, 'index'])->name('tests.index');

Route::get('/test/{testId}', [TestController::class, 'show'])->name('test.show');
Route::post('/answer/{question}', [TestController::class, 'submit'])->name('answer.submit');
Route::get('/test/{testId}/result', [TestController::class, 'result'])->name('test.result');
Route::get('/test/{testId}/retry', [TestController::class, 'retry'])->name('test.retry');




Route::middleware(['auth'])->group(function () {
    Route::post('/questions/{id}/save', [SavedQuestionController::class, 'save'])->name('questions.save');
    Route::get('/saved-questions', [SavedQuestionController::class, 'index'])->name('saved_questions.index');
});
