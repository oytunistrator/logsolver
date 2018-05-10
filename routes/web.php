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
Route::get('/logs', 'LogController@index');
Route::get('/logs/data', 'LogController@data');
Route::get('/logs/uploader', 'LogController@uploader');
Route::post('/logs/store', 'LogController@store');
Route::get('/logentries', 'LogEntryController@index');
Route::post('/logentries/data', 'LogEntryController@data');