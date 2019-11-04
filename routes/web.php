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

Route::post('/b','AdminController@getQuestion')->name('testDB_post');

Route::get('/p',function () {
   return view('welcome');
});

Route::get('/test-db',function () {
    return view('testDB');
});

Route::get('/listing/detail',function () {
    return view('detail');
});

Route::get('/listing/index',function () {
    return view('index');
});

Route::get('/listing/listing',function () {
    return view('listing');
});
