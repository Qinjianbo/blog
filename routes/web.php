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

// 首页路由
Route::get('/', 'BlogController@list');

// 博客跳转路由
Route::get('/blog/{id}', 'BlogController@show')->where('id', '\d+');
Route::get('/blog/add', function () {
    return view('blog.edit_blog');
});
Route::get('/blog/edit/{id}', 'BlogController@edit')->where('id', '\d+');
Route::get('/my/blogs', function () {
    return view('blog.blog');
});

// 关于波波
Route::get('/about', function () {
    return view('about');
});
Route::get('profile', function() {
    return view('profile');
});

// 验证码相关路由
Route::get('/checkCaptcha', 'CaptchaController@check')->where('captcha', '\s+');
Route::get('/captcha', function () {
    return Captcha::create();
});
