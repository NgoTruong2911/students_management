<?php

use Illuminate\Http\Request;

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
// Route::group(['prefix' => 'auth'], function () {
//     Route::get('login','AuthController@login');
//     Route::post('signup','AuthController@login');
// });
// Route::group(['middleware' => 'logout'], function () {
//     Route::get('logout','AuthController@logout');
//     Route::get('index','AuthController@index');
// });

// Route::group(['middleware' => 'auth'], function () {
    Route::get('users','User\UserController@index')->name('api-users');
// });
