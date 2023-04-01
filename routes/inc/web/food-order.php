<?php

use App\Http\Controllers\Admin\FoodOrderController as AdminFoodOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodOrderController;

Route::prefix('food-order')->middleware(['auth'])->group(function () {
    Route::get('/', [FoodOrderController::class, 'index'])->name('food-order.index');
    Route::get('/{food_order}', [FoodOrderController::class, 'show'])->name('food-order.show');
    Route::put('/{food_order}', [FoodOrderController::class, 'update'])->name('food-order.update');
    Route::delete('/{food_order}/delete', [FoodOrderController::class, 'destroy'])->name('food-order.delete');
});
