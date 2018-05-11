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

Route::get('/', 'HomeController@index');
Route::get('/logs', 'LogController@index');
Route::get('/logs/data', 'LogController@data');
Route::get('/logs/delete/{id}', 'LogController@delete');
Route::get('/logs/view/{id}', 'LogController@view');
Route::get('/logs/uploader', 'LogController@uploader');
Route::post('/logs/store', 'LogController@store');
Route::get('/logentries', 'LogEntryController@index');
Route::get('/logentries/view/{id}', 'LogEntryController@view');
Route::get('/logentries/data', 'LogEntryController@data');