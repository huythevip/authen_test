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

Route::get('/home', 'PagesController@home')->name('home');
Route::get('about', 'TestController@about')->name('about');
Route::get('index', 'PagesController@index')->name('index');
Route::get('/', function () {
    return ;
});

//Auth Controller
Route::get('login', 'AuthController@getLoginForm')->name('login.get');
Route::post('login', 'AuthController@login')->name('login.post');
Route::get('register', 'UserController@getRegistrationForm')->name('register.get');
Route::post('register', 'UserController@postRegister')->name('register.post');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('activate/token={token}', 'UserController@getActivate')->name('activate');

//Reset Password Controller
Route::post('resetpassword', 'ResetPasswordController@postResetPassword')->name('reset.password');
Route::get('resetpassword/token={token}', 'ResetPasswordController@getSetNewPassword')->name('setNew.password');
Route::post('resetpassword/token={token}', 'ResetPasswordController@postUpdatePassword')->name('update.password');

