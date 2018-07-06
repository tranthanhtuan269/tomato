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

Route::get('/', 'HomeController@index')->name('welcome');
Auth::routes();
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('channels/{id}', 'ChannelController@show');
Route::post('channels/store', 'ChannelController@store');
Route::resource('groups', 'GroupController');
Route::resource('users', 'UserController');
Route::resource('conversations', 'ConversationController');
