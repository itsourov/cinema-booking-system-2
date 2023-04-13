<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\FoodOrderController;
use App\Http\Controllers\Admin\FoodOrderController as AdminFoodOrderController;

Route::prefix('food-order')->middleware(['auth'])->group(function () {
    Route::get('/', [FoodOrderController::class, 'index'])->name('food-order.index');
    Route::get('/{food_order}', [FoodOrderController::class, 'show'])->name('food-order.show');
    Route::post('/{food_order}/cancel', [FoodOrderController::class, 'cancel'])->name('food-order.cancel');
    Route::post('stripe-payment/{food_order}', [StripeController::class, 'FoodOrderpayment'])->name('stripe.food-order.payment');
    Route::get('stripe-payment/success}', [StripeController::class, 'successFoodOrder'])->name('stripe.food-order.success');
    Route::delete('/{food_order}/delete', [FoodOrderController::class, 'destroy'])->name('food-order.delete');
});