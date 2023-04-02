<?php

use App\Domains\Paths\Cotrollers\PathsController;
use App\Domains\Payments\Controllers\CouponsController;
use App\Domains\Payments\Controllers\StripeIpnController;
use App\Domains\Posts\Controllers\PostsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EasyAccessController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemFilesController;
use App\Http\Controllers\NewsletterSubscribersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PayuController;
use App\Http\Controllers\ProofsController;
use App\Http\Controllers\QuickSalesController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\TpayController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/learn/routes.php';
require __DIR__ . '/axios.php';
require __DIR__ . '/auth.php';

Route::get('/', PagesController::class . '@home');
Route::any('/payu/notify', PayuController::class . '@notify');

Route::post('/search', PagesController::class . '@search');

Route::get('/courses', CoursesController::class . '@index')->name('courses');
Route::get('/course', CoursesController::class . '@redirect');
Route::get('/course/{course}', CoursesController::class . '@show');
Route::get('/course/{course}/buy', OrderController::class . '@orderCourse');

Route::get('/paths', PathsController::class . '@index')->name('paths.index');

// strony różniste
Route::get('/account', AccountController::class . '@show')->name('account.show');
Route::get('/account/mycourses', AccountController::class . '@myCourses')->name('account.mycourses');
Route::post('/account', AccountController::class . '@update');
Route::post('/account/change_password', AccountController::class . '@changePassword');
Route::patch('/user', AccountController::class . '@patch');

Route::group(['prefix' => 'coupon'], function () {
    Route::get('/redeem', CouponsController::class . '@show');
    Route::post('/redeem', CouponsController::class . '@use')->name('coupon.redeem');
});

Route::get('/cart', OrderController::class . '@showCart');
Route::get('/continue', PagesController::class . '@continue');
Route::get('/buy_access', PagesController::class . '@buyAccess')->name('buy_access');
Route::view('/buy_access2', 'buy_access2')->name('buy_access2');
Route::get('/cart/add_full_access', OrderController::class . '@addFullAccess');
Route::get('/cart/remove_full_access', OrderController::class . '@removeFullAccess');
Route::get('/cart/add_subscription', OrderController::class . '@addSubscription');

Route::get('/easy_access', EasyAccessController::class . '@showForm');
Route::get('/easy_access/add/{duration}', EasyAccessController::class . '@add');

Route::get('/order/{order}/course/{course_id}/remove', OrderController::class . '@removeCourse');
Route::get('/order/{order}/lesson/{lesson_id}/remove', OrderController::class . '@removeLesson');
Route::post('/order/{order}/pay', OrderController::class . '@pay')->name('order.pay');
Route::post('/order/{order}/add_coupon', OrderController::class . '@addCoupon');
Route::get('/order/{order}/remove_easy_access', OrderController::class . '@removeEasyAccess');
Route::get('/order/{order}/remove_coupon/{coupon}', OrderController::class . '@removeCoupon');
Route::get('/order/{order}/request-invoice', OrderController::class . '@requestInvoice')->name('order.request-invoice');

Route::post('subscription/create', SubscriptionsController::class . '@create');
Route::get('/subscription/{subscription}/cancel', SubscriptionsController::class . '@cancel');

Route::get('/home', HomeController::class . '@admin');

Route::get('/unsubscribe/{code}', EmailsController::class . '@unsubscribe');
Route::get('/email/{email}/img', EmailsController::class . '@getOpenedImg');

Route::post('newsletter/subscribe', NewsletterSubscribersController::class . '@subscribe');

Route::get('/itemfile/{file}', ItemFilesController::class . '@download');

Route::get('/certificate/{certificate}/download', CertificatesController::class . '@download');
Route::get('/check_cert', CertificatesController::class . '@check');

Route::post('/get_proofs', ProofsController::class . '@get');
Route::get('/proofs/next', ProofsController::class . '@axiosGet');

Route::post('/contact_form', ContactFormController::class . '@send');

Route::get('/ranking', RankingController::class . '@index');
Route::get('/a/ranking/my', RankingController::class . '@my');
Route::get('/a/ranking/month', RankingController::class . '@month');
Route::get('/a/ranking/total', RankingController::class . '@total');

Route::get('/p/{partner}', PartnerController::class . '@index');

Route::get('tpay', TpayController::class . '@showGate');
Route::any('tpay/success', TpayController::class . '@success');
Route::any('tpay/error', TpayController::class . '@error');
Route::any('tpay/notify', TpayController::class . '@notification');
Route::any('tpay/ipn', TpayController::class . '@ipn');

Route::group(['prefix' => 'qs'], function () {
    Route::get('/{hash}', QuickSalesController::class . '@show');
    Route::post('/{hash}/order', QuickSalesController::class . '@order');
    Route::post('/{hash}/prevalidate', QuickSalesController::class . '@prevalidate');
    Route::post('/{hash}/finish', QuickSalesController::class . '@finish');
    Route::post('/{hash}/finish_free', QuickSalesController::class . '@finishFree');
    Route::post('/{hash}/check_coupon', QuickSalesController::class . '@checkCoupon');
});

Route::group([
    'prefix'     => 'posts',
    'as'         => 'posts.',
    'middleware' => 'auth',
], function () {
    Route::get('/', PostsController::class . '@index')->name('index');
    Route::get('/{slug}', PostsController::class . '@show')->name('show');
});

Route::get('/payments/{payment}/request-invoice', PaymentsController::class . '@requestInvoice');
Route::any('/stripe/ipn', StripeIpnController::class)->name('stripe.ipn');

// To musi być na samym końcu, by nie blokowało innych ścieżek
Route::get('/{page}/{subpage?}', PageController::class . '@show');

