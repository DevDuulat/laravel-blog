<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['ru', 'kg'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');




//Посты
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('index');
    Route::get('/{slug}', [ContentController::class, 'show'])->name('show');
});


Route::get('/tests', [TestController::class, 'index'])->name('tests.index');

Route::get('/pages', [ContentController::class, 'pagesIndex'])->name('pages.index');
Route::get('/pages/{slug}', [ContentController::class, 'showPage'])->name('pages.show');




Route::get('/traffic-signs', [ContentController::class, 'trafficSigns'])->name('traffic.signs');
Route::get('/road-markings', [ContentController::class, 'roadMarkings'])->name('road.markings');
Route::get('/fines', [ContentController::class, 'fines'])->name('fines');


//Route::get('/test/saved', [TestController::class, 'savedQuestions'])->name('questions.saved');
//Route::get('/test/saved/result', [TestController::class, 'savedTestResult'])->name('test.savedResult');


Route::get('/test/{testId}', [TestController::class, 'show'])->name('test.show');
Route::post('/answer/{question}', [TestController::class, 'submit'])->name('answer.submit');
Route::get('/test/{testId}/result', [TestController::class, 'result'])->name('test.result');
Route::get('/test/{testId}/retry', [TestController::class, 'retry'])->name('test.retry');


Route::get('/faq', [HomeController::class, 'faqPage'])->name('faq');

//Route::get('/dashboard', [DashboardController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
