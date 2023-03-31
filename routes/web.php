<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\VideoJsController;

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
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/upload', [UploadController::class, 'store']);
    Route::delete('/upload', [UploadController::class, 'destroy']);
});


Route::prefix('movies')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/{movie}', [MovieController::class, 'show'])->name('movies.show');
});
Route::prefix('shows')->group(function () {
    Route::get('/', [ShowController::class, 'index'])->name('shows.index');
    Route::get('/{show}', [ShowController::class, 'show'])->name('shows.show');
});


Route::get('/my-recomendation', [RecomendationController::class, 'index'])->middleware('auth')->name('recomendation');
Route::get('/video-js/{ticket}', [VideoJsController::class, 'view'])->middleware('auth')->name('videojs.view');

Route::get('/reset', function () {
    Artisan::call('migrate:fresh', ['--seed' => ' ']);
    return back();
})->name('reset');


Route::get('/test', [Controller::class, 'test']);
require __DIR__ . '/inc/web/auth.php';
require __DIR__ . '/inc/web/admin.php';
require __DIR__ . '/inc/web/ticket.php';
require __DIR__ . '/inc/web/food.php';
require __DIR__ . '/inc/web/food-order.php';