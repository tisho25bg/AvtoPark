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


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('dashboard');

Route::get('/profile/', 'ProfileController@profile');

//TODO: Трябва да се направи като resource, за да има префикс admin
Route::get('/admin/', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/manager/', ['as' => 'manager', 'uses' => 'ManagerController@index']);
Route::get('/driver/', ['as' => 'driver', 'uses' => 'DriverController@index']);
Route::get('/customer/', ['as' => 'customer', 'uses' => 'CustomerController@index']);

Route::get('/admin/create-user', 'AdminController@createUser')->name('create-user');
Route::post('/admin/create-user', 'AdminController@storeUser');


