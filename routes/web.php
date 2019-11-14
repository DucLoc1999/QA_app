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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    return view('master');
});


Route::get('/listing/detail',function () {
    return view('detail');
});

Route::get('/listing/index',function () {
    return view('index');
});

Route::get('/listing/listing','SessionController@secsion_list');

Route::resource('session', 'SessionController');
Route::resource('question', 'QuestionController');

Route::get('session', 'SessionController@index');
Route::get('session/create', 'SessionController@create');
Route::post('session', 'SessionController@store');
Route::get('session/{session}/edit', 'SessionController@edit');

Route::get('session/{session_id}/{question_id}/check password', function ($session_id, $question_id){
    return view('check_session_password', compact('session_id', 'question_id'));
});
Route::post('session/check password', 'SessionController@checkPassword');


Route::get('question/create', 'QuestionController@create');
Route::post('question', 'QuestionController@store');
Route::get('question/{question}/edit', 'QuestionController@edit');

Route::middleware(['sessionPassword'])->group(function () {
    Route::get('session/{session}', 'SessionController@show');
    Route::get('question', 'QuestionController@index');
    Route::get('question/{question}', 'QuestionController@show');
    Route::post('answer', 'AnswerController@postCheck');
    Route::post('comment', 'CommentController@create');
});
