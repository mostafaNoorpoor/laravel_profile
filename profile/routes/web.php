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

Route::get('/', function () {
    return view('home');
});
Route::get('/hello', function () {
    return view('hello');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/Contact', function () {
    return view('Contact');
});
Route::post('Contact/submit', 'MessageController@submit');