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
        // 登录相关路由
        Route::post('/session', 'UserController@signin');
        Route::delete('/session/{id}/{device}', 'UserController@signout');
        Route::get('/session/{id}/{device}', 'UserController@isSignin');

        // 注册路由
        Route::post('/user', 'UserController@signup');

        // 非登录权限的博客相关路由
        Route::get('/blogs', 'BlogController@list');
        Route::get('/blog/{id}', 'BlogController@get')->where('id', '\d+');

        // 需要登录权限的博客操作相关路由
        Route::group(['prefix' => 'user', 'middleware' => 'check_login'], function () {
            Route::post('/blog', 'BlogController@create');
            Route::put('/blog/{id}', 'BlogController@update')->where('id', '\d+');
            Route::delete('/blog/{id}', 'BlogController@delete')->where('id', '\d+');
            Route::get('/blog/{id}', 'BlogController@get')->where('id', '\d+');
            Route::get('/blogs', 'BlogController@myList');
        });
    });
});
Route::group(['prefix' => 'xcx'], function () {
    Route::group(['prefix' => 'v1'], function() {
        Route::get('/login', 'XcxController@login');
    });
});
