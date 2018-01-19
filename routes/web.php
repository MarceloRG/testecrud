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

Route::get('/', 'CrudController@index')->name('home');
Route::get('create', 'CrudController@create')->name('create');
Route::post('store', 'CrudController@store')->name('store');
Route::get('edit/{id}', 'CrudController@edit')->name('edit');
Route::get('destroy/{id}', 'CrudController@destroy')->name('destroy');
Route::put('update/{id}', 'CrudController@update')->name('update');
