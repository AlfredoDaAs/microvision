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

Route::get('/globalftpaddress', function () {
    return view('global_ftp_address');
});

Route::get('/cm_mgmt', function () {
    return view('cm_mgmt');
});

Route::get('/manufacturer_mgmt', function () {
    return view('manufacturer_mgmt');
});

Route::get('/manufacturer_access', function () {
    return view('manufacturer_access');
});

Route::get('/user_mgmt', function () {
    return view('user_mgmt');
});

Route::get('/asic_manufacturer', function () {
    return view('asic_manufacturer');
});

Route::get('/upload_confirmation', function () {
    return view('upload_confirmation');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
