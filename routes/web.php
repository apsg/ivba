<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home');

Route::post('/search', 'PagesController@search');

Route::get('/courses', 'CoursesController@index');
Route::get('/course', function () {
    return redirect('/courses', 301);
});
Route::get('/course/{course}', 'CoursesController@show');
Route::get('/course/{course}/buy', 'OrderController@orderCourse');

Route::get('/learn/course/{course}', 'LearnController@showCourse');
Route::get('/learn/course/{course}/lesson/{lesson}', 'LearnController@showCourse');
Route::get('/learn/course/{course}/lesson/{lesson}/finish', 'LearnController@finishLesson');
Route::get('/learn/course/{course}/finished', 'LearnController@finishedCourse');
Route::post('/learn/course/{course}/rate', 'LearnController@rate');

Route::get('/learn/course/{course}/quiz/{quiz}', 'QuizController@showQuiz');
Route::get('/learn/course/{course}/quiz/{quiz}/start', 'QuizController@start');
Route::post('/question/{question}/answer', 'QuestionsController@checkAnswer');

Route::get('/learn/lesson/{lesson}', 'LearnController@showLesson');
Route::get('/learn/lesson/{lesson}/finish', 'LearnController@finishLesson');

Route::get('/lesson/{lesson}', 'LessonsController@show');
Route::get('/lesson/{lesson}/buy', 'OrderController@orderLesson');

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

Route::get('subscription/create', 'PayPalController@create');
Route::get('/subscription/{subscription}/cancel', 'SubscriptionsController@cancel');

Route::get('/home', function () {
    return redirect('admin');
});

Route::get('/unsubscribe/{code}', 'EmailsController@unsubscribe');
Route::get('/email/{email}/img', 'EmailsController@getOpenedImg');

Route::post('newsletter/subscribe', 'NewsletterSubscribersController@subscribe');

Route::get('/itemfile/{file}', 'ItemFilesController@download');


Route::get('/certificate/{certificate}/download', 'CertificatesController@download');
Route::get('/check_cert', 'CertificatesController@check');

Route::post('/get_proofs', 'ProofsController@get');

Route::post('/contact_form', 'ContactFormController@send');

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
    Route::get('/users/data', 'AdminUserController@getData');
    Route::get('/user/{user}', 'AdminUserController@edit');
    Route::patch('/user/{user}', 'AdminUserController@patch');
    Route::get('/user/{user}/delete', 'AdminUserController@delete');
    Route::get('/user/{user}/send_password', 'AdminUserController@sendPassword');

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


    Route::post('update_editable', 'AdminEditablesController@update');
});

Route::any('/paypal/ec-checkout-success', 'PayPalController@checkoutSuccess');
Route::any('paypal/notify', 'PayPalController@notify');

Route::get('/test', function () {

    throw new Exception('test');

});

// To musi być na samym końcu, by nie blokowało innych ścieżek
Route::get('/{page}/{subpage?}', 'PageController@show');

