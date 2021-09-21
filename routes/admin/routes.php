<?php

use App\Domains\Admin\Controllers\AnalyticsController;
use App\Domains\Admin\Controllers\LoginAsUserController;
use App\Domains\Admin\Controllers\SettingsController;
use App\Domains\Logbooks\Controllers\Admin\LogbookCommentsController;
use App\Domains\Logbooks\Controllers\Admin\LogbooksController;
use App\Domains\Quicksales\Controller\BaselinkerController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\Courses\CourseUsersController;
use App\Http\Controllers\AdminCertificatesController;
use App\Http\Controllers\AdminCouponsController;
use App\Http\Controllers\AdminCoursesController;
use App\Http\Controllers\AdminEditablesController;
use App\Http\Controllers\AdminImagesController;
use App\Http\Controllers\AdminInvoicesController;
use App\Http\Controllers\AdminItemsController;
use App\Http\Controllers\AdminLessonController;
use App\Http\Controllers\AdminMenusController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\AdminPaymentsController;
use App\Http\Controllers\AdminQuestionOptionsController;
use App\Http\Controllers\AdminQuestionsController;
use App\Http\Controllers\AdminQuickSalesController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AdminScriptsController;
use App\Http\Controllers\AdminSubcriptionsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminVideosController;
use App\Http\Controllers\FollowupsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewslettersController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class . '@index')->name('home');

Route::get('/login/{data}', LoginAsUserController::class . '@login')->name('login');

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', AdminCoursesController::class . '@index')->name('courses.index');
    Route::post('/', AdminCoursesController::class . '@store');
    Route::get('/new', AdminCoursesController::class . '@create');
    Route::get('/list', AdminCoursesController::class . '@list')->name('courses.list');
    Route::get('/logbook', LogbooksController::class . '@getData')->name('logbook.data');
    Route::get('/{course}', AdminCoursesController::class . '@show')->name('course.edit');
    Route::patch('/{course}', AdminCoursesController::class . '@update');
    Route::delete('/{course}', AdminCoursesController::class . '@delete')->name('course.delete');
    Route::post('/{course}/lesson_order', AdminCoursesController::class . '@updateLessonOrder');
    Route::post('/{course}/delays', AdminCoursesController::class . '@updateLessonDelay');
    Route::post('/_order', AdminCoursesController::class . '@updateOrder');
    Route::get('/{course}/duplicate', AdminCoursesController::class . '@duplicate')
        ->name('course.duplicate');
    Route::get('/{course}/users', CourseUsersController::class . '@index')->name('course.users');
    Route::get('/{course}/users/data', CourseUsersController::class . '@getData')->name('course.users.data');
});

Route::get('/lesson', AdminLessonController::class . '@index');
Route::post('lesson', AdminLessonController::class . '@store');
Route::get('lesson/new', AdminLessonController::class . '@create');
Route::get('lesson/{lesson}', AdminLessonController::class . '@show');
Route::patch('lesson/{lesson}', AdminLessonController::class . '@update');
Route::post('/lesson/{lesson}/items', AdminItemsController::class . '@add');
Route::post('/lesson/{lesson}/items_order', AdminLessonController::class . '@updateItemsOrder');

Route::get('/itemfile/{item}/delete', AdminItemsController::class . '@deleteFile');
Route::get('/itemimage/{item}/delete', AdminItemsController::class . '@deleteImage');
Route::get('/itemmovie/{item}/delete', AdminItemsController::class . '@deleteMovie');
Route::get('/itemtext/{item}/delete', AdminItemsController::class . '@deleTetext');

Route::get('images', AdminImagesController::class . '@index');
Route::post('images', AdminImagesController::class . '@store');

Route::get('videos', AdminVideosController::class . '@index');
Route::post('videos', AdminVideosController::class . '@store');
Route::post('videos/import', AdminVideosController::class . '@import');

Route::get('/pages', AdminPagesController::class . '@index');
Route::get('/pages/new', AdminPagesController::class . '@create');
Route::get('/pages/{page}', AdminPagesController::class . '@show');
Route::post('/pages', AdminPagesController::class . '@store');
Route::patch('/pages/{page}', AdminPagesController::class . '@update');

Route::get('/coupon', AdminCouponsController::class . '@index')->name('coupons.index');
Route::get('/coupon/new', AdminCouponsController::class . '@create');
Route::get('/coupon/{coupon}', AdminCouponsController::class . '@show');
Route::get('/coupon/{coupon}/delete', AdminCouponsController::class . '@delete');
Route::get('/coupon/{coupon}/edit', AdminCouponsController::class . '@edit');
Route::post('/coupon', AdminCouponsController::class . '@store');
Route::patch('/coupon/{coupon}', AdminCouponsController::class . '@update');
Route::post('/coupons/groupon', AdminCouponsController::class . '@groupon');

Route::get('/user', AdminUserController::class . '@index');
Route::get('/user/partners', AdminUserController::class . '@partner')->name('users.partners');
Route::get('/user/ranking/{type}', AdminUserController::class . '@ranking');

Route::get('/users/data', AdminUserController::class . '@getData');
Route::get('/user/{user}', AdminUserController::class . '@edit');
Route::patch('/user/{user}', AdminUserController::class . '@patch');
Route::get('/user/{user}/delete', AdminUserController::class . '@delete')->name('users.delete');
Route::get('/user/{user}/send_password', AdminUserController::class . '@sendPassword')
    ->name('users.send_password');
Route::post('/user/{user}/grant_full_access', AdminUserController::class . '@grantFullAccess')
    ->name('users.full_access');
Route::post('/user/{user}/grant_subscription_access', AdminUserController::class . '@grantSubscriptionAccess')
    ->name('users.subscription_access');
Route::get('/user/{user}/cancel_full_access', AdminUserController::class . '@cancelFullAccess')
    ->name('users.cancel_full_access');
Route::get('/users/expired_report', AdminUserController::class . '@expiredReport')
    ->name('users.expired_report');

Route::get('/menu', AdminMenusController::class . '@index');
Route::post('/menu', AdminMenusController::class . '@store');
Route::post('/menu/items_order', AdminMenusController::class . '@updateOrder');
Route::delete('/menu/{item}', AdminMenusController::class . '@delete');

Route::get('/newsletters', NewslettersController::class . '@index');
Route::post('/newsletters', NewslettersController::class . '@store');
Route::get('/newsletters/new', NewslettersController::class . '@create');
Route::get('/newsletters/{newsletter}', NewslettersController::class . '@edit');
Route::patch('/newsletters/{newsletter}', NewslettersController::class . '@patch');

Route::get('/followups', FollowupsController::class . '@index');
Route::post('/followups', FollowupsController::class . '@store');
Route::get('/followups/new', FollowupsController::class . '@create');
Route::get('/followups/{followup}', FollowupsController::class . '@edit');
Route::patch('/followups/{followup}', FollowupsController::class . '@patch');
Route::get('/followups/{followup}/test', FollowupsController::class . '@sendTest');
Route::get('/followups/{followup}/delete', FollowupsController::class . '@destroy');

Route::get('quizzes', AdminQuizController::class . '@index');
Route::post('quizzes', AdminQuizController::class . '@store');
Route::get('/quizzes/{quiz}', AdminQuizController::class . '@show');
Route::get('/quizzes/{quiz}/stats', AdminQuizController::class . '@statistics');
Route::patch('/quizzes/{quiz}', AdminQuizController::class . '@patch');
Route::get('/quizzes/{quiz}/delete', AdminQuizController::class . '@delete');
Route::post('/quizzes/{quiz}/question_order', AdminQuizController::class . '@updateOrder');

Route::post('/quizzes/{quiz}/questions', AdminQuestionsController::class . '@store');
Route::patch('question/{question}', AdminQuestionsController::class . '@patch');
Route::delete('question/{question}', AdminQuestionsController::class . '@delete');

Route::post('/question/{question}/options', AdminQuestionOptionsController::class . '@store');
Route::delete('/question_option/{option}', AdminQuestionOptionsController::class . '@delete');

Route::get('/certificates', AdminCertificatesController::class . '@index');
Route::post('/certificates', AdminCertificatesController::class . '@store');
Route::get('/certificates/{certificate}/delete', AdminCertificatesController::class . '@delete');

Route::get('/orders', AdminOrdersController::class . '@index');
Route::get('/orders/data', AdminOrdersController::class . '@getData');

Route::get('scripts', AdminScriptsController::class . '@index');
Route::post('scripts', AdminScriptsController::class . '@store');
Route::get('scripts/{script}', AdminScriptsController::class . '@edit');
Route::patch('scripts/{script}', AdminScriptsController::class . '@patch');
Route::get('scripts/{script}/delete', AdminScriptsController::class . '@delete');

Route::get('subscriptions/{subscription}/cancel', AdminSubcriptionsController::class . '@cancel');

Route::get('payments', AdminPaymentsController::class . '@index');
Route::get('/payments/data', AdminPaymentsController::class . '@getData');

Route::post('update_editable', AdminEditablesController::class . '@update');

Route::group(['prefix' => 'quicksales'], function () {
    Route::get('/', AdminQuickSalesController::class . '@index');
    Route::get('/create', AdminQuickSalesController::class . '@create');
    Route::post('/', AdminQuickSalesController::class . '@store');
    Route::delete('/{quickSale}', AdminQuickSalesController::class . '@destroy');
    Route::get('/{quickSale}', AdminQuickSalesController::class . '@show');
    Route::put('/{quickSale}', AdminQuickSalesController::class . '@update')->name('quicksale.update');
    Route::get('/{quickSale}/report', AdminQuickSalesController::class . '@downloadReport');
    Route::get('/{quickSale}/baselinker_new', AdminQuickSalesController::class . '@createBaselinkerProduct');
});

Route::group(['prefix' => 'baselinker'], function () {
    Route::get('/products', BaselinkerController::class . '@index');
});

Route::group(['prefix' => 'invoices'], function () {
    Route::get('/', AdminInvoicesController::class . '@index')->name('invoice.index');
    Route::get('/{invoiceRequest}/accept',
        AdminInvoicesController::class . '@accept')->name('invoice.accept');
    Route::get('/{invoiceRequest}/reject',
        AdminInvoicesController::class . '@reject')->name('invoice.reject');
    Route::get('/{invoiceRequest}/edit', AdminInvoicesController::class . '@edit')->name('invoice.edit');
    Route::post('/{invoiceRequest}/update',
        AdminInvoicesController::class . '@update')->name('invoice.update');
});

Route::group([
    'prefix' => 'settings',
], function () {
    Route::get('/', SettingsController::class . '@index');
    Route::post('/set', SettingsController::class . '@set')->name('settings.set');
    Route::delete('/delete', SettingsController::class . '@destroy')->name('settings.delete');
});

Route::group([
    'prefix' => 'access',
], function () {
    Route::get('/{user}', AccessController::class . '@index')->name('access.inde');
    Route::post('/', AccessController::class . '@store')->name('access.store');
    Route::delete('/', AccessController::class . '@revoke')->name('access.revoke');
    Route::delete('/{access}', AccessController::class . '@destroy')->name('access.delete');
});

Route::group([
    'prefix' => 'analytics',
], function () {
    Route::get('/', AnalyticsController::class . '@index')->name('analytics.index');
    Route::get('/data', AnalyticsController::class . '@data')->name('analytics.data');
    Route::get('/export', AnalyticsController::class . '@export')->name('analytics.export');
});

Route::group([
    'prefix' => 'logbooks',
], function () {
    Route::group([
        'prefix' => 'comments',
    ], function () {
        Route::post('/', LogbookCommentsController::class . '@store');
        Route::delete('/{comment}', LogbookCommentsController::class . '@destroy');
    });

    Route::get('/', LogbooksController::class . '@index')->name('logbooks.index');
    Route::get('/new', LogbooksController::class . '@create')->name('logbooks.create');
    Route::post('/', LogbooksController::class . '@store')->name('logbooks.store');
    Route::get('/{logbook}', LogbooksController::class . '@edit')->name('logbooks.edit');
    Route::put('/{logbook}', LogbooksController::class . '@update')->name('logbooks.update');
    Route::delete('/{logbook}', LogbooksController::class . '@destroy')->name('logbooks.destroy');
});
