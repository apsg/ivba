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

Route::any('/payu/notify', 'PayuController@notify');
Route::any('/process_subscription', 'PayuController@process');
Route::get('/continue/{order}', 'PayuController@continueOrder');
Route::any('/continue_recurring', 'PayuController@continueRecurring');
Route::any('/notify_recurring', 'PayuController@notifyRecurring');
Route::get('/subscription_success', 'PayuController@subscriptionSuccess');

Route::get('/order/{order}/course/{course_id}/remove', 'OrderController@removeCourse');
Route::get('/order/{order}/lesson/{lesson_id}/remove', 'OrderController@removeLesson');
Route::get('/order/{order}/pay', 'OrderController@pay');
Route::post('/order/{order}/add_coupon', 'OrderController@addCoupon');
Route::get('/order/{order}/remove_coupon/{coupon}', 'OrderController@removeCoupon');

Route::get('subscription/create', 'SubscriptionsController@create');
Route::get('/subscription/{subscription}/cancel', 'SubscriptionsController@cancel');

Route::get('/home', 'HomeController@admin');

Route::get('/unsubscribe/{code}', 'EmailsController@unsubscribe');
Route::get('/email/{email}/img', 'EmailsController@getOpenedImg');

Route::post('newsletter/subscribe', 'NewsletterSubscribersController@subscribe');

Route::get('/itemfile/{file}', 'ItemFilesController@download');


Route::get('/certificate/{certificate}/download', 'CertificatesController@download');
Route::get('/check_cert', 'CertificatesController@check');

Route::post('/get_proofs', 'ProofsController@get');

Route::post('/contact_form', 'ContactFormController@send');

Route::any('/paypal/ec-checkout-success', 'PayPalController@checkoutSuccess');
Route::any('paypal/notify', 'PayPalController@notify');

Route::get('/test', function () {

    throw new Exception('test');

});


Route::get('tpay', 'TpayController@showGate');
Route::get('tpay/success', 'TpayController@debug');
Route::get('tpay/error', 'TpayController@debug');
Route::any('tpay/notify', 'TpayController@notification');

// To musi być na samym końcu, by nie blokowało innych ścieżek
Route::get('/{page}/{subpage?}', 'PageController@show');

