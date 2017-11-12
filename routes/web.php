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

Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'admin'], function ()
{
	Route::get('/', [
		'as'	 => 'admin',
		'uses'	 => 'AdminController@index',
		'roles'	 => ['admin'],
	]);

	Route::get('/users', [
		'as'	 => 'users',
		'uses'	 => 'AdminController@users',
		'roles'	 => ['admin'],
	]);

	Route::get('/create-user', [
		'as'	 => 'create-user',
		'uses'	 => 'AdminController@createUser',
		'roles'	 => ['admin'],
	]);

	Route::post('/create-user', [
		'as'	 => 'create-user',
		'uses'	 => 'AdminController@storeUser',
		'roles'	 => 'admin',
	]);

	Route::get('/delete-user/{id}', [
		'as'	 => 'delete-user',
		'uses'	 => 'AdminController@deleteUser',
		'roles'	 => ['admin'],
	]);

	Route::get('/edit-user/{id}', [
		'as'	 => 'edit-user',
		'uses'	 => 'AdminController@editUser',
		'roles'	 => 'admin',
	]);
	Route::post('/edit-user/{id}', [
		'as'	 => 'edit-user',
		'uses'	 => 'AdminController@saveUser',
		'roles'	 => 'admin',
	]);
});
Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'manager'], function ()
{
	Route::get('/', [
		'as'	 => 'manager',
		'uses'	 => 'ManagerController@index',
		'roles'	 => ['manager', 'admin'],
	]);

	Route::get('/create-vehicle', [
		'as'	 => 'create-vehicle',
		'uses'	 => 'ManagerController@createVehicle',
		'roles'	 => ['admin', 'manager'],
	]);

	Route::post('/create-vehicle', [
		'as'	 => 'create-vehicle',
		'uses'	 => 'ManagerController@storeVehicle',
		'roles'	 => ['admin', 'manager'],
	]);

	Route::get('/show-vehicles', [
		'as'	 => 'show-vehicles',
		'uses'	 => 'ManagerController@showVehicles',
		'roles'	 => ['admin', 'manager']
	]);
	Route::get('/delete-vehicle/{id}', [
		'as'	 => 'delete-vehicle',
		'uses'	 => 'ManagerController@deleteVehicle',
		'roles'	 => ['admin', 'manager'],
	]);

	Route::get('/maps', [
		'as'	 => 'maps',
		'uses'	 => 'ManagerController@maps',
		'roles'	 => ['admin', 'manager']
	]);
	Route::get('/edit-vehicle/{id}', [
		'as'	 => 'edit-vehicle',
		'uses'	 => 'ManagerController@editVehicle',
		'roles'	 => ['admin', 'manager'],
	]);
	Route::post('/edit-vehicle/{id}', [
		'as'	 => 'edit-vehicle',
		'uses'	 => 'ManagerController@saveVehicle',
		'roles'	 => ['admin', 'manager'],
	]);
});

Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'customer'], function ()
{
	Route::get('/', [
		'as'	 => 'customer',
		'uses'	 => 'CustomerController@index',
		'roles'	 => ['customer'],
	]);
});

Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'driver'], function ()
{
	Route::get('/', [
		'as'	 => 'driver',
		'uses'	 => 'DriverController@index',
		'roles'	 => ['driver'],
	]);
});
