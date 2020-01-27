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



Route::get('/', 'PostsController@index');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Route of POST
Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'PostsController@index')->name('posts');
    Route::get('/create', 'PostsController@create')->name('posts.create');
    Route::post('/store', 'PostsController@store')->name('posts.store');
    Route::get('/edit/{id}', 'PostsController@edit')->name('posts.edit');
    Route::put('/update/{id}', 'PostsController@update')->name('posts.update');
    Route::get('/{id}', 'PostsController@show')->name('posts.show');
    Route::delete('/delete/{id}', 'PostsController@destroy')->name('posts.delete');
});
