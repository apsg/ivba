<?php

Route::get('/learn/course/{course}', 'LearnController@showCourse');
Route::get('/learn/course/{course}/lesson/{lesson}', 'LearnController@showCourse');
Route::get('/learn/course/{course}/lesson/{lesson}/finish', 'LearnController@finishLesson');
Route::get('/learn/course/{course}/finished', 'LearnController@finishedCourse');
Route::post('/learn/course/{course}/rate', 'LearnController@rate');

Route::get('/learn/course/{course}/quiz/{quiz}', 'QuizController@showQuiz');
Route::get('/learn/course/{course}/quiz/{quiz}/start', 'QuizController@start');

Route::get('/learn/lesson/{lesson}', 'LearnController@showLesson');
Route::get('/learn/lesson/{lesson}/finish', 'LearnController@finishLesson');

Route::get('/lesson/{lesson}', 'LessonsController@show');
Route::get('/lesson/{lesson}/buy', 'OrderController@orderLesson');

Route::post('/question/{question}/answer', 'QuestionsController@checkAnswer');
