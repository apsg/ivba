<?php

use App\Domains\Payments\Controllers\QuickFullAccessOrderController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubscriptionsController;
use Illuminate\Support\Facades\Route;

Route::get('/lessons/random/{number}', LessonsController::class . '@random');

Route::group(['prefix' => 'a'], function () {
    Route::get('/courses', CoursesController::class . '@list');
    Route::post('/check_coupon', SubscriptionsController::class . '@checkCoupon');

    Route::post('/order/check_coupon', OrderController::class . '@checkCoupon');
    Route::post('/order/quick_full_access', QuickFullAccessOrderController::class . '@order');
});
