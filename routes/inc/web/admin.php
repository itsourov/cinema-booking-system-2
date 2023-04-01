<?php




use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\ShowController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');


    Route::prefix('movies')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('admin.movies');
        Route::get('/create', [MovieController::class, 'create'])->name('admin.movies.create');
        Route::post('/create', [MovieController::class, 'store']);

        Route::get('/genres', [GenreController::class, 'index'])->name('admin.movies.genres');
        Route::post('/genres', [GenreController::class, 'store']);

        Route::get('/{movie}', [MovieController::class, 'edit'])->name('admin.movies.edit');
        Route::put('/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
        Route::delete('/{movie}', [MovieController::class, 'destroy'])->name('admin.movies.delete');
    });
    Route::prefix('shows')->group(function () {
        Route::get('/', [ShowController::class, 'index'])->name('admin.shows');
        Route::get('/upcoming', [ShowController::class, 'upcoming'])->name('admin.shows.upcoming');
        Route::get('/create', [ShowController::class, 'createGuide'])->name('admin.shows.create.guide');
        Route::get('/create/{movie}', [ShowController::class, 'create'])->name('admin.shows.create');
        Route::post('/create/{movie}', [ShowController::class, 'store']);
        Route::get('/{show}', [ShowController::class, 'edit'])->name('admin.shows.edit');
        Route::get('/{show}/preview', [ShowController::class, 'show'])->name('admin.shows.show');
        Route::put('/{show}', [ShowController::class, 'update'])->name('admin.shows.update');
        Route::delete('/{show}', [ShowController::class, 'destroy'])->name('admin.shows.delete');
    });
    Route::prefix('foods')->group(function () {
        Route::get('/', [FoodController::class, 'index'])->name('admin.foods.index');
        Route::get('/create', [FoodController::class, 'create'])->name('admin.foods.create');
        Route::post('/create', [FoodController::class, 'store']);
        Route::get('/{food}', [FoodController::class, 'edit'])->name('admin.foods.edit');
        Route::put('/{food}', [FoodController::class, 'update'])->name('admin.foods.update');
        Route::delete('/{food}/delete', [FoodController::class, 'destroy'])->name('admin.foods.delete');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    Lfm::routes();
});

Route::get('seat2', function () {
    return view('seat2');
});
