<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuizController;

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/learn/course/{course}', LearnController::class . '@showCourse');
    Route::get('/learn/course/{course}/lesson/{lesson}', LearnController::class . '@showCourse');
    Route::get('/learn/course/{course}/lesson/{lesson}/finish', LearnController::class . '@finishLesson');
    Route::get('/learn/course/{course}/finished', LearnController::class . '@finishedCourse');
    Route::post('/learn/course/{course}/rate', LearnController::class . '@rate');
    Route::get('/learn/course/{course}/progress', CourseController::class . '@progress');

    Route::get('/learn/course/{course}/quiz/{quiz}', QuizController::class . '@showQuiz');
    Route::get('/learn/course/{course}/quiz/{quiz}/start', QuizController::class . '@start');
    Route::get('/learn/course/{course}/quiz/{quiz}/reset', QuizController::class . '@reset');

    Route::get('/learn/lesson/{lesson}', LearnController::class . '@showLesson');
    Route::get('/learn/lesson/{lesson}/finish', LearnController::class . '@finishLesson');

    Route::get('/lesson/{lesson}', LessonsController::class . '@show');
    Route::get('/lesson/{lesson}/buy', OrderController::class . '@orderLesson');

    Route::post('/question/{question}/answer', QuestionsController::class . '@checkAnswer');
});
