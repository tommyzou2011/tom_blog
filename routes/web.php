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
    return view('welcome');
});

//登陆路由
Route::middleware('web')->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'LoginController@login');
    Route::post('user/login', 'UserController@login');
});

//后台主页
Route::middleware('web','userCheck')->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('user', 'UserController@index');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');

    Route::resource('category', 'CategoryController');
});

//工具类路由
Route::middleware('web')->prefix('tool')->namespace('Tool')->group(function () {
    //验证码
    Route::get('captcha/{tmp?}', 'CaptchaController@captcha')->where('tmp', '[0-9]+');

});


