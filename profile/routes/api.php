<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user/{id}', 'MessageController@getUserData');

Route::post('/registerNewUser', 'MessageController@registerNewUser');

Route::post('/updateProfile', 'MessageController@updateUser');

Route::post('/logIn', 'MessageController@logIn');


//->name('data')
// Route::get('/user', function () {
//     return [
//         'name' => 'amir',
//         'family' => 'parsa',
//         'roles' => [
//             'super-admin',
//             'admin'
//         ],
//     ];
// });