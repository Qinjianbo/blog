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

Route::get('/', function () {
   // return view('home');
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});
Route::get('/blog/{id}', 'BlogController@show')->where('id', '\d+');

//Route::get('/freshman', function () {
//    return view('freshman');
//});

//Route::get('/about', function () {
//    return view('about');
//});
Route::get('profile', function() {
    return view('profile');
});
