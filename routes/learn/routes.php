<?php

use App\Domains\Forms\Controllers\FormsController;
use App\Domains\Logbooks\Controllers\LogbookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
], function () {
    Route::group([
        'prefix' => 'learn',
    ], function () {
        Route::get('/course/{course}', LearnController::class . '@showCourse');
        Route::get('/course/{course}/lesson/{lesson}', LearnController::class . '@showCourse');
        Route::get('/course/{course}/lesson/{lesson}/finish', LearnController::class . '@finishLesson');
        Route::get('/course/{course}/finished', LearnController::class . '@finishedCourse');
        Route::post('/course/{course}/rate', LearnController::class . '@rate');
        Route::get('/course/{course}/progress', CourseController::class . '@progress');

        Route::get('/course/{course}/quiz/{quiz}', QuizController::class . '@showQuiz');
        Route::get('/course/{course}/quiz/{quiz}/start', QuizController::class . '@start');
        Route::get('/course/{course}/quiz/{quiz}/reset', QuizController::class . '@reset');

        Route::get('/lesson/{lesson}', LearnController::class . '@showLesson');
        Route::get('/lesson/{lesson}/finish', LearnController::class . '@finishLesson');

        Route::get('/course/{course}/logbooks', LogbookController::class . '@index');
        Route::get('/course/{course}/logbook/{logbook}', LogbookController::class . '@show')
            ->name('learn.course.logbook');
        Route::post('/course/{course}/logbook/{logbook}', LogbookController::class . '@storeEntry')
            ->name('learn.logbook.store');

        Route::get('/course/{course}/form/{form}', FormsController::class . '@show')->name('learn.course.form');
        Route::post('/course/{course}/form/{form}', FormsController::class . '@store')->name('learn.course.form.store');
    });

    Route::get('/lesson/{lesson}', LessonsController::class . '@show');
    Route::get('/lesson/{lesson}/buy', OrderController::class . '@orderLesson');

    Route::post('/question/{question}/answer', QuestionsController::class . '@checkAnswer');
});
