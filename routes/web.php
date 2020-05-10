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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'PostController@index');
    Route::resource('user', 'UserController')->only([
        'show', 'edit', 'update', 'destroy'
    ]);
    Route::resource('posts', 'PostController')->only([
        'index', 'store', 'destroy'
    ]);;
});

Auth::routes();
