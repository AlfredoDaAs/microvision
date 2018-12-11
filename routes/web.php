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

/* Microvision Adminstration route access */
Route::get('/', 'AdminController@home');
Route::get('/home', 'AdminController@home')->name('home');
Route::get('/ftp_address', 'AdminController@ftp_address')->name('ftp_address');
Route::post('/update_ftp_settings', 'AdminController@update_ftp_settings')->name('update_ftp_settings');
Route::get('/cm_management', 'AdminController@cm_management')->name('cm_management');
Route::post('/cm_management/new_input', 'AdminController@cm_mgmt_new');
Route::post('/cm_management/save', 'AdminController@cm_mgmt_save')->name('cm_mgmt_save');
Route::get('/manufacturer_management', 'AdminController@manufacturer_mgmt')->name('manufacturer_mgmt');
Route::get('/manufacturer_access', 'AdminController@manufacturer_access')->name('manufacturer_access');
Route::get('/user_management', 'AdminController@user_mgmt')->name('user_mgmt');

Route::get('/asic_manufacturer', function () {
    return view('asic_manufacturer');
});

Route::get('/upload_confirmation', function () {
    return view('upload_confirmation');
});