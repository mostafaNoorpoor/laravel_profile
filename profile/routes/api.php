<?php

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

Route::get('/user/{id}', 'MessageController@getUserData');

Route::post('/registerNewUser', 'MessageController@registerNewUser');

Route::post('/updateProfile', 'MessageController@updateUser');

//Route::post('/logIn', 'MessageController@logIn');

Route::post('/checkAdmin', 'MessageController@checkAdmin');

Route::get('/userRoles/{id}', 'MessageController@userRoles');

Route::get('/checkAdminOrUser/{id}', 'MessageController@checkAdminOrUser');

Route::post('/setRoleAndPermission', 'MessageController@setRoleAndPermission');

// Route::post('/login', 'AuthController@login');

// Route::post('/signup', 'AuthController@signup');

// Route::get('/logout', 'AuthController@logout');

// Route::get('/user', 'AuthController@user');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
