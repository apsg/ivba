<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('courses', 'AdminCoursesController@index');
    Route::post('courses', 'AdminCoursesController@store');
    Route::get('courses/new', 'AdminCoursesController@create');
    Route::get('courses/{course}', 'AdminCoursesController@show');
    Route::patch('courses/{course}', 'AdminCoursesController@update');
    Route::delete('courses/{course}', 'AdminCoursesController@delete');
    Route::post('courses/{course}/lesson_order', 'AdminCoursesController@updateLessonOrder');
    Route::post('courses_order', 'AdminCoursesController@updateOrder');

    Route::get('/lesson', 'AdminLessonController@index');
    Route::post('lesson', 'AdminLessonController@store');
    Route::get('lesson/new', 'AdminLessonController@create');
    Route::get('lesson/{lesson}', 'AdminLessonController@show');
    Route::patch('lesson/{lesson}', 'AdminLessonController@update');
    Route::post('/lesson/{lesson}/items', 'AdminItemsController@add');
    Route::post('/lesson/{lesson}/items_order', 'AdminLessonController@updateItemsOrder');

    Route::get('/itemfile/{item}/delete', 'AdminItemsController@deleteFile');
    Route::get('/itemimage/{item}/delete', 'AdminItemsController@deleteImage');
    Route::get('/itemmovie/{item}/delete', 'AdminItemsController@deleteMovie');
    Route::get('/itemtext/{item}/delete', 'AdminItemsController@deleTetext');

    Route::get('images', 'AdminImagesController@index');
    Route::post('images', 'AdminImagesController@store');

    Route::get('videos', 'AdminVideosController@index');
    Route::post('videos', 'AdminVideosController@store');
    Route::post('videos/import', 'AdminVideosController@import');

    Route::get('/pages', 'AdminPagesController@index');
    Route::get('/pages/new', 'AdminPagesController@create');
    Route::get('/pages/{page}', 'AdminPagesController@show');
    Route::post('/pages', 'AdminPagesController@store');
    Route::patch('/pages/{page}', 'AdminPagesController@update');

    Route::get('/coupon', 'AdminCouponsController@index');
    Route::get('/coupon/new', 'AdminCouponsController@create');
    Route::get('/coupon/{coupon}', 'AdminCouponsController@show');
    Route::get('/coupon/{coupon}/delete', 'AdminCouponsController@delete');
    Route::get('/coupon/{coupon}/edit', 'AdminCouponsController@edit');
    Route::post('/coupon', 'AdminCouponsController@store');
    Route::patch('/coupon/{coupon}', 'AdminCouponsController@update');

    Route::get('/user', 'AdminUserController@index');
    Route::get('/user/partners', 'AdminUserController@partner')->name('admin.users.partners');
    Route::get('/user/ranking/{type}', 'AdminUserController@ranking');

    Route::get('/users/data', 'AdminUserController@getData');
    Route::get('/user/{user}', 'AdminUserController@edit');
    Route::patch('/user/{user}', 'AdminUserController@patch');
    Route::get('/user/{user}/delete', 'AdminUserController@delete')->name('admin.users.delete');
    Route::get('/user/{user}/send_password', 'AdminUserController@sendPassword')
        ->name('admin.users.send_password');
    Route::post('/user/{user}/grant_full_access', 'AdminUserController@grantFullAccess')
        ->name('admin.users.full_access');
    Route::post('/user/{user}/grant_subscription_access', 'AdminUserController@grantSubscriptionAccess')
        ->name('admin.users.subscription_access');
    Route::get('/user/{user}/cancel_full_access', 'AdminUserController@cancelFullAccess')
        ->name('admin.users.cancel_full_access');

    Route::get('/menu', 'AdminMenusController@index');
    Route::post('/menu', 'AdminMenusController@store');
    Route::post('/menu/items_order', 'AdminMenusController@updateOrder');
    Route::delete('/menu/{item}', 'AdminMenusController@delete');

    Route::get('/newsletters', 'NewslettersController@index');
    Route::post('/newsletters', 'NewslettersController@store');
    Route::get('/newsletters/new', 'NewslettersController@create');
    Route::get('/newsletters/{newsletter}', 'NewslettersController@edit');
    Route::patch('/newsletters/{newsletter}', 'NewslettersController@patch');

    Route::get('/followups', 'FollowupsController@index');
    Route::post('/followups', 'FollowupsController@store');
    Route::get('/followups/new', 'FollowupsController@create');
    Route::get('/followups/{followup}', 'FollowupsController@edit');
    Route::patch('/followups/{followup}', 'FollowupsController@patch');
    Route::get('/followups/{followup}/test', 'FollowupsController@sendTest');
    Route::get('/followups/{followup}/delete', 'FollowupsController@destroy');

    Route::get('quizzes', 'AdminQuizController@index');
    Route::post('quizzes', 'AdminQuizController@store');
    Route::get('/quizzes/{quiz}', 'AdminQuizController@show');
    Route::get('/quizzes/{quiz}/stats', 'AdminQuizController@statistics');
    Route::patch('/quizzes/{quiz}', 'AdminQuizController@patch');
    Route::get('/quizzes/{quiz}/delete', 'AdminQuizController@delete');
    Route::post('/quizzes/{quiz}/question_order', 'AdminQuizController@updateOrder');

    Route::post('/quizzes/{quiz}/questions', 'AdminQuestionsController@store');
    Route::patch('question/{question}', 'AdminQuestionsController@patch');
    Route::delete('question/{question}', 'AdminQuestionsController@delete');

    Route::post('/question/{question}/options', 'AdminQuestionOptionsController@store');
    Route::delete('/question_option/{option}', 'AdminQuestionOptionsController@delete');

    Route::get('/certificates', 'AdminCertificatesController@index');
    Route::post('/certificates', 'AdminCertificatesController@store');
    Route::get('/certificates/{certificate}/delete', 'AdminCertificatesController@delete');

    Route::get('/orders', 'AdminOrdersController@index');
    Route::get('/orders/data', 'AdminOrdersController@getData');

    Route::get('scripts', 'AdminScriptsController@index');
    Route::post('scripts', 'AdminScriptsController@store');
    Route::get('scripts/{script}', 'AdminScriptsController@edit');
    Route::patch('scripts/{script}', 'AdminScriptsController@patch');
    Route::get('scripts/{script}/delete', 'AdminScriptsController@delete');

    Route::get('subscriptions/{subscription}/cancel', 'AdminSubcriptionsController@cancel');

    Route::get('payments', 'AdminPaymentsController@index');
    Route::get('/payments/data', 'AdminPaymentsController@getData');

    Route::post('update_editable', 'AdminEditablesController@update');

    Route::group(['prefix' => 'quicksales'], function () {
        Route::get('/', 'AdminQuickSalesController@index');
        Route::get('/create', 'AdminQuickSalesController@create');
        Route::post('/', 'AdminQuickSalesController@store');
        Route::delete('/{quickSale}', 'AdminQuickSalesController@destroy');
        Route::get('/{quickSale}', 'AdminQuickSalesController@show');
        Route::put('/{quickSale}', 'AdminQuickSalesController@update')->name('admin.quicksale.update');
        Route::get('/{quickSale}/report', 'AdminQuickSalesController@downloadReport');
    });

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', 'AdminInvoicesController@index')->name('admin.invoice.index');
        Route::get('/{invoiceRequest}/accept', 'AdminInvoicesController@accept')->name('admin.invoice.accept');
        Route::get('/{invoiceRequest}/reject', 'AdminInvoicesController@reject')->name('admin.invoice.reject');
        Route::get('/{invoiceRequest}/edit', 'AdminInvoicesController@edit')->name('admin.invoice.edit');
        Route::post('/{invoiceRequest}/update', 'AdminInvoicesController@update')->name('admin.invoice.update');
    });

});
