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

Auth::routes();

Route::get('/', 'WelcomeController');

Route::view('/about', 'about');
Route::resource('/news', 'NewsController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/loguserout', 'HomeController@logout');
