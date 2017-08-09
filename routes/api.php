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
    Route::post('/session', 'UserController@signin');
    Route::delete('/session', 'UserController@signout');

    Route::post('/user', 'UserController@signup');

    Route::post('/blog', 'BlogController@save');
    Route::get('/blogs', 'BlogController@list');
    Route::get('/blog/{id}', 'BlogController@show')->where('id', '[1-9]+');
    Route::put('/blog/{id}', 'BlogController@save')->where('id', '\d+');
});
