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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//user
Route::resource('user','UserController');
Route::get('/add_bulk','UserController@add_bulk');
// Route::post('/upload_users','UserController@upload_users');
Route::post('user/upload_users','UserController@upload_users');



