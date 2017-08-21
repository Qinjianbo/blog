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
    Route::group(['prefix' => 'v1'], function () {
        Route::post('/session', 'UserController@signin');
        Route::delete('/session/{id}/{device}', 'UserController@signout');
        Route::get('/session/{id}/{device}', 'UserController@isSignin');

        Route::post('/user', 'UserController@signup');


        Route::post('/blog', 'BlogController@create');
        Route::delete('/blog/{user_id}/{id}', 'BlogController@update')->where('user_id', '[0-9a-zA-Z]+')->where('id', '\d+');
        Route::get('/blogs', 'BlogController@list');
        Route::get('/blog/{id}', 'BlogController@get')->where('id', '\d+');
        Route::put('/blog/{id}', 'BlogController@save')->where('id', '\d+');
    });
});
