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

Route::get('/home', 'AdminController@home');
Route::get('/ftp_address', 'AdminController@ftp_address');
Route::get('/cm_management', 'AdminController@cm_management');
Route::get('/manufacturer_management', 'AdminController@manufacturer_mgmt');
Route::get('/manufacturer_access', 'AdminController@manufacturer_access');
Route::get('/user_management', 'AdminController@user_mgmt');

Route::get('/asic_manufacturer', function () {
    return view('asic_manufacturer');
});

Route::get('/upload_confirmation', function () {
    return view('upload_confirmation');
});

Auth::routes();

Route::get('/home2', 'HomeController@index')->name('home');
