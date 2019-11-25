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
    return redirect('/session');
})->name('home_ss');

//user


Route::get('/listing/detail',function () {
    return view('detail');
});
Route::get('/listing',function () {
    return view('listing');
});

Route::get('/listing/index',function () {
    return view('index');
});

Route::get('/listing/listing','SessionController@secsion_list');

Route::resource('session', 'SessionController');
Route::resource('question', 'QuestionController');
Route::resource('survey', 'SurveyController');

Route::get('session/create', 'SessionController@create');
Route::post('session', 'SessionController@store');
Route::get('session/{session}/edit', 'SessionController@edit');

Route::get('session/{session_id}/check_password', function ( $session_id, \Illuminate\Http\Request $request){
    return view('check_session_password', compact('session_id', 'request'));
});
Route::post('session/check_password', 'SessionController@checkPassword');


Route::get('question/create', 'QuestionController@create');
Route::post('question', 'QuestionController@store');
Route::get('question/{question}/edit', 'QuestionController@edit');


Route::middleware(['checkSessionPassword'])->group(function () {
    Route::get('session/{session}', 'SessionController@show');
    Route::get('session/{session}/survey', 'SurveyController@showSurvey');
    Route::get('session/{session}/survey_statistic', 'SurveyController@showStatistic');
    Route::get('question', 'QuestionController@index');
    Route::get('question/{question}', 'QuestionController@show');
    Route::post('answer', 'AnswerController@postCheck');
    Route::post('comment', 'CommentController@create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/// auth
// Authentication Routes...
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => 'post_login',
    'uses' => 'Auth\LoginController@login'
]);
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);
// Password Reset Routes...
Route::post('password/email', [
    'as' => 'password.email',
    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
    'as' => 'password.update',
    'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
]);
// Registration Routes...
Route::get('register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
    'as' => 'post_register',
    'uses' => 'Auth\RegisterController@register'
]);
