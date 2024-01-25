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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('house', 'HouseController');
Route::resource('floor', 'FloorController');
Route::resource('flat', 'FlatController');
Route::resource('customer', 'CustomerController');
Route::resource('bill', 'BillController');
Route::get('monthly-report', 'ReportController@index')->name('monthlyReport.index');
Route::post('monthly-report', 'ReportController@monthlyReport')->name('monthlyReport.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
