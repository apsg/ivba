<?php

use App\Domains\Admin\Controllers\AnalyticsController;
use App\Domains\Admin\Controllers\LoginAsUserController;
use App\Domains\Admin\Controllers\SettingsController;
use App\Domains\Quicksales\Controller\BaselinkerController;
use App\Http\Controllers\Admin\AccessController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', HomeController::class . '@index')->name('home');

    Route::get('/login/{data}', LoginAsUserController::class . '@login')->name('admin.login');

    Route::get('courses', AdminCoursesController::class . '@index');
    Route::post('courses', AdminCoursesController::class . '@store');
    Route::get('courses/new', AdminCoursesController::class . '@create');
    Route::get('/courses/list', AdminCoursesController::class . '@list');
    Route::get('courses/{course}', AdminCoursesController::class . '@show');
    Route::patch('courses/{course}', AdminCoursesController::class . '@update');
    Route::delete('courses/{course}', AdminCoursesController::class . '@delete')->name('admin.course.delete');
    Route::post('courses/{course}/lesson_order', AdminCoursesController::class . '@updateLessonOrder');
    Route::post('courses/{course}/delays', AdminCoursesController::class . '@updateLessonDelay');
    Route::post('courses_order', AdminCoursesController::class . '@updateOrder');
    Route::get('courses/{course}/duplicate', AdminCoursesController::class . '@duplicate')
        ->name('admin.course.duplicate');

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

    Route::get('/coupon', AdminCouponsController::class . '@index');
    Route::get('/coupon/new', AdminCouponsController::class . '@create');
    Route::get('/coupon/{coupon}', AdminCouponsController::class . '@show');
    Route::get('/coupon/{coupon}/delete', AdminCouponsController::class . '@delete');
    Route::get('/coupon/{coupon}/edit', AdminCouponsController::class . '@edit');
    Route::post('/coupon', AdminCouponsController::class . '@store');
    Route::patch('/coupon/{coupon}', AdminCouponsController::class . '@update');
    Route::post('/coupons/groupon', AdminCouponsController::class . '@groupon');

    Route::get('/user', AdminUserController::class . '@index');
    Route::get('/user/partners', AdminUserController::class . '@partner')->name('admin.users.partners');
    Route::get('/user/ranking/{type}', AdminUserController::class . '@ranking');

    Route::get('/users/data', AdminUserController::class . '@getData');
    Route::get('/user/{user}', AdminUserController::class . '@edit');
    Route::patch('/user/{user}', AdminUserController::class . '@patch');
    Route::get('/user/{user}/delete', AdminUserController::class . '@delete')->name('admin.users.delete');
    Route::get('/user/{user}/send_password', AdminUserController::class . '@sendPassword')
        ->name('admin.users.send_password');
    Route::post('/user/{user}/grant_full_access', AdminUserController::class . '@grantFullAccess')
        ->name('admin.users.full_access');
    Route::post('/user/{user}/grant_subscription_access', AdminUserController::class . '@grantSubscriptionAccess')
        ->name('admin.users.subscription_access');
    Route::get('/user/{user}/cancel_full_access', AdminUserController::class . '@cancelFullAccess')
        ->name('admin.users.cancel_full_access');
    Route::get('/users/expired_report', AdminUserController::class . '@expiredReport')
        ->name('admin.users.expired_report');

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
        Route::put('/{quickSale}', AdminQuickSalesController::class . '@update')->name('admin.quicksale.update');
        Route::get('/{quickSale}/report', AdminQuickSalesController::class . '@downloadReport');
        Route::get('/{quickSale}/baselinker_new', AdminQuickSalesController::class . '@createBaselinkerProduct');
    });

    Route::group(['prefix' => 'baselinker'], function () {
        Route::get('/products', BaselinkerController::class . '@index');
    });

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', AdminInvoicesController::class . '@index')->name('admin.invoice.index');
        Route::get('/{invoiceRequest}/accept',
            AdminInvoicesController::class . '@accept')->name('admin.invoice.accept');
        Route::get('/{invoiceRequest}/reject',
            AdminInvoicesController::class . '@reject')->name('admin.invoice.reject');
        Route::get('/{invoiceRequest}/edit', AdminInvoicesController::class . '@edit')->name('admin.invoice.edit');
        Route::post('/{invoiceRequest}/update',
            AdminInvoicesController::class . '@update')->name('admin.invoice.update');
    });

    Route::group([
        'prefix' => 'settings',
    ], function () {
        Route::get('/', SettingsController::class . '@index');
        Route::post('/set', SettingsController::class . '@set')->name('admin.settings.set');
        Route::delete('/delete', SettingsController::class . '@destroy')->name('admin.settings.delete');
    });

    Route::group([
        'prefix' => 'access',
    ], function () {
        Route::get('/{user}', AccessController::class . '@index')->name('admin.access.inde');
        Route::post('/', AccessController::class . '@store')->name('admin.access.store');
        Route::delete('/', AccessController::class . '@revoke')->name('admin.access.revoke');
        Route::delete('/{access}', AccessController::class . '@destroy')->name('admin.access.delete');
    });

    Route::group([
        'prefix' => 'analytics',
    ], function () {
        Route::get('/', AnalyticsController::class . '@index')->name('admin.analytics.index');
        Route::get('/data', AnalyticsController::class . '@data')->name('admin.analytics.data');
        Route::get('/export', AnalyticsController::class . '@export')->name('admin.analytics.export');
    });
});
