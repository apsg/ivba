<?php

Route::get('/lessons/random/{number}', 'LessonsController@random');

Route::group(['prefix' => 'a'], function () {
    Route::get('/courses', 'CoursesController@list');
    Route::post('/check_coupon', 'SubscriptionsController@checkCoupon');
});
