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


Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', 'User\UserController@profile')->name('users.profile');
    // Route::get('edit/profile', 'User\UserController@editProfile')->name('users.editProfile');
    // Route::post('update/profile', 'User\UserController@updateProfile')->name('users.updateProfile');
    Route::group(['middleware' => 'role:admin'], function () {
        // Route::resource('users', 'User\UserController');

        Route::get('users','User\UserController@index')->name('users.index');
        Route::post('users','User\UserController@store')->name('users.store');
        Route::get('users/create','User\UserController@create')->name('users.create');
        Route::get('users/{user}/edit','User\UserController@edit')->name('users.edit');
        Route::put('users/{user}','User\UserController@update')->name('users.update');
        Route::delete('users/{user}','User\UserController@destroy')->name('users.destroy');
        Route::get('users/{slug}','User\UserController@show')->name('users.show');

        Route::resource('faculties', 'Faculty\FacultyController');
        Route::resource('subjects', 'Subject\SubjectController');
        // Route::post('create-point/{id}', 'User\UserController@createPoint')->name('users.createPoint');
        Route::resource('points', 'Point\PointController');
        Route::resource('roles', 'Role\RoleController');
        Route::get('send-email', 'User\UserController@sendEmail')->name('users.sendEmail');
    });
    Route::group(['middleware' => 'role:user|admin'], function () {
        Route::resource('faculties', 'Faculty\FacultyController')->except('destroy','create','edit','store','update');
        Route::resource('subjects', 'Subject\SubjectController')->except('destroy','create','edit','store','update');
        Route::resource('users', 'User\UserController')->except('destroy','create','store');
        Route::post('create-point/{id}', 'User\UserController@createPoint')->name('users.createPoint');
    });

});
Auth::routes();
Route::get('/redirect', 'Social\SocialAuthGoogleController@redirect');
Route::get('/callback', 'Social\SocialAuthGoogleController@callback');
Route::get('/home', 'HomeController@index')->name('home');
