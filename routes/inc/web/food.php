<?php

use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;

Route::prefix('food')->middleware([])->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('food.index');
});
