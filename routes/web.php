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

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/form', 'FormController@index');
Route::get('/form/add', 'FormController@add');
Route::get('/form/edit/{id}', 'FormController@edit');
Route::get('/form/view/{id}', 'FormController@view');
Route::get('/form/html/{id}', 'FormController@html');
Route::get('/form/delete/{id}', 'FormController@delete');

Route::resource('form', 'FormController');

