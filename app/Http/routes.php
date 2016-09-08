<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('home');
});

Route::get('infos', 'ContentController@infos');
Route::get('preise', 'ContentController@preise');
Route::get('training', 'ContentController@training');
Route::get('stundenplan', 'ContentController@stundenplan');
Route::get('team', 'ContentController@team');
Route::get('logout', 'AdminController@logout');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
// Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    Route::get('admin/stundenplan', 'AdminController@stundenplanDashboard');
    Route::get('admin/', function () {
        return redirect('admin/stundenplan');
    });

    //Stundenplan routes
    Route::resource('admin/trainer', 'TrainerController');
    Route::resource('admin/kurse', 'KursController');
    Route::resource('admin/stundenplaene', 'VersionenController');
    Route::resource('admin/modul', 'StundenplanController');

    //Turnier Routes
    Route::resource('admin/gyms', 'GymController');
    Route::resource('admin/fighters', 'FighterController');


});
