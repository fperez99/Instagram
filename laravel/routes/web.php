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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/config', 'UserController@config')->name('user.config');
Route::post('/user/config', 'UserController@update')->name('user.update');
Route::get('/storage/users/{filename}', 'UserController@getImage')->where('filename', '[A-z0-9\s\.]+')->name('user.avatar');

Route::get('/images/formy', 'ImageController@formy')->where('filename', '[A-z0-9\s\.]+')->name('image.crearImage');
Route::post('/images/formy', 'ImageController@create')->name('image.save');
Route::get('storage/images/{filename}', 'ImageController@getImage')->where('filename', '[A-z0-9_\s\.]+')->name('image.file');

Route::get('/profile/{id}','UserController@profile')->name('user.profile');
