<?php

require __DIR__ . '/admin/routes.php';
require __DIR__ . '/learn/routes.php';
require __DIR__ . '/axios.php';

Route::get('/', 'PagesController@home');

Route::post('/search', 'PagesController@search');

Route::get('/courses', 'CoursesController@index');
Route::get('/course', 'CoursesController@redirect');
Route::get('/course/{course}', 'CoursesController@show');
Route::get('/course/{course}/buy', 'OrderController@orderCourse');

Auth::routes();

// strony różniste
Route::get('/account', 'AccountController@show');
Route::post('/account', 'AccountController@update');
Route::post('/account/change_password', 'AccountController@changePassword');
Route::patch('/user', 'AccountController@patch');

Route::get('/cart', 'OrderController@showCart');
Route::get('/continue', 'PagesController@continue');
Route::get('/buy_access', 'PagesController@buyAccess');
Route::get('/cart/add_full_access', 'OrderController@addFullAccess');
Route::get('/cart/remove_full_access', 'OrderController@removeFullAccess');
Route::get('/cart/add_subscription', 'OrderController@addSubscription');

Route::get('/easy_access', 'EasyAccessController@showForm');
Route::get('/easy_access/add/{duration}', 'EasyAccessController@add');

Route::get('/order/{order}/course/{course_id}/remove', 'OrderController@removeCourse');
Route::get('/order/{order}/lesson/{lesson_id}/remove', 'OrderController@removeLesson');
Route::post('/order/{order}/pay', 'OrderController@pay')->name('order.pay');
Route::post('/order/{order}/add_coupon', 'OrderController@addCoupon');
Route::get('/order/{order}/remove_easy_access', 'OrderController@removeEasyAccess');
Route::get('/order/{order}/remove_coupon/{coupon}', 'OrderController@removeCoupon');
Route::get('/order/{order}/request-invoice', 'OrderController@requestInvoice')->name('order.request-invoice');

Route::post('subscription/create', 'SubscriptionsController@create');
Route::get('/subscription/{subscription}/cancel', 'SubscriptionsController@cancel');

Route::get('/home', 'HomeController@admin');

Route::get('/unsubscribe/{code}', 'EmailsController@unsubscribe');
Route::get('/email/{email}/img', 'EmailsController@getOpenedImg');

Route::post('newsletter/subscribe', 'NewsletterSubscribersController@subscribe');

Route::get('/itemfile/{file}', 'ItemFilesController@download');


Route::get('/certificate/{certificate}/download', 'CertificatesController@download');
Route::get('/check_cert', 'CertificatesController@check');

Route::post('/get_proofs', 'ProofsController@get');
Route::get('/proofs/next', 'ProofsController@axiosGet');

Route::post('/contact_form', 'ContactFormController@send');

Route::get('/ranking', 'RankingController@index');
Route::get('/a/ranking/my', 'RankingController@my');
Route::get('/a/ranking/month', 'RankingController@month');
Route::get('/a/ranking/total', 'RankingController@total');

Route::get('/p/{partner}', 'PartnerController@index');

Route::get('tpay', 'TpayController@showGate');
Route::any('tpay/success', 'TpayController@success');
Route::any('tpay/error', 'TpayController@error');
Route::any('tpay/notify', 'TpayController@notification');
Route::any('tpay/ipn', 'TpayController@ipn');

Route::group(['prefix' => 'qs'], function () {
    Route::get('/{hash}', 'QuickSalesController@show');
    Route::post('/{hash}/order', 'QuickSalesController@order');
    Route::post('/{hash}/prevalidate', 'QuickSalesController@prevalidate');
    Route::post('/{hash}/finish', 'QuickSalesController@finish');
});

Route::get('/payments/{payment}/request-invoice', 'PaymentsController@requestInvoice');


// To musi być na samym końcu, by nie blokowało innych ścieżek
Route::get('/{page}/{subpage?}', 'PageController@show');
