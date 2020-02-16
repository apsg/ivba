<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\SubscriptionsController;

Route::get('/lessons/random/{number}', 'LessonsController@random');

Route::group(['prefix' => 'a'], function () {
    Route::get('/courses', CoursesController::class . '@list');
    Route::post('/check_coupon', SubscriptionsController::class . '@checkCoupon');
});
