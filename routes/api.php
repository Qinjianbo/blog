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
Route::group(['prefix' => 'home'], function () {
    Route::get('/signin', 'UserController@signin');
    Route::get('/signout', 'UserController@signout');
    Route::get('/signup', 'UserController@signup');
});
