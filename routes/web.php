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
Route::get('index', 'PagesController@index')->name('index');


//AuthController
Route::get('login', 'AuthController@getLoginForm')->name('login.get');
Route::post('login', 'AuthController@login')->name('login.post');
Route::get('register', 'AuthController@getRegistrationForm')->name('register.get');
Route::post('register', 'AuthController@postRegister')->name('register.post');
Route::get('logout', 'AuthController@logout')->name('logout');