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
Route::post('/manufacturer_management/new_input', 'AdminController@manufacturer_mgmt_new');
Route::post('/manufacturer_management/save', 'AdminController@manufacturer_mgmt_save')->name('manufacturer_mgmt_save');

Route::get('/manufacturer_access', 'AdminController@manufacturer_access')->name('manufacturer_access');
Route::post('/manufacturer_access/cms', 'AdminController@manufacturer_access_cms')->name('manufacturer_access_cms');
Route::post('/manufacturer_access/save', 'AdminController@manufacturer_access_save')->name('manufacturer_access_save');

Route::get('/user_management', 'AdminController@user_mgmt')->name('user_mgmt');
Route::post('/user_management/save', 'AdminController@user_mgmt_save')->name('user_mgmt_save');
Route::post('/user_management/delete', 'AdminController@user_mgmt_delete')->name('user_mgmt_delete');

Route::post('/load_user', 'AdminController@load_user')->name('load_user');
Route::post('/load_users_card', 'AdminController@load_users_card')->name('load_users_card');

Route::get('/asic_manufacturer', 'ManufacturerController@asic_manufacturer')->name('asic_manufacturer');
Route::get('/upload_confirmation', 'ManufacturerController@upload_confirmation')->name('upload_confirmation');