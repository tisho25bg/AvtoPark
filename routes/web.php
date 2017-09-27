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
//Route::get('/admin/', ['as' => 'admin', 'uses' => 'AdminController@index']);
Route::get('/manager/', ['as' => 'manager', 'uses' => 'ManagerController@index']);
Route::get('/driver/', ['as' => 'driver', 'uses' => 'DriverController@index']);
Route::get('/customer/', ['as' => 'customer', 'uses' => 'CustomerController@index']);




Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'admin'], function ()
{
    Route::get('/', [
        'as'    => 'admin',
        'uses'  => 'AdminController@index',
        'roles' => ['admin'],
    ]);

    Route::get('/create-user', [
        'as'    => 'create-user',
        'uses'  => 'AdminController@createUser',
        'roles' => ['admin'],
    ] )->name('create-user');

    Route::post('/create-user', [
        'as'    =>  'create-user',
        'uses'  =>  'AdminController@storeUser',
        'roles' =>  'admin',
    ]);

    Route::get('/create-vehicle', [
        'as'    => 'create-vehicle',
        'uses'  => 'AdminController@createVehicle',
        'roles' => ['admin'],
    ] );

    Route::post('/create-vehicle', [
        'as'    =>  'create-vehicle',
        'uses'  =>  'AdminController@storeVehicle',
        'roles' =>  'admin',
    ]);
}
);
Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'manager'], function ()
{
    Route::get('/', [
        'as'    => 'manager',
        'uses'  => 'ManagerController@index',
        'roles' => ['manager'],
    ]);
}
);

Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'customer'], function ()
{
    Route::get('/', [
        'as'    => 'customer',
        'uses'  => 'CustomerController@index',
        'roles' => ['customer'],
    ]);
}
);

Route::group(['middleware' => ['auth', 'roles'], 'prefix' => 'driver'], function ()
{
    Route::get('/', [
        'as'    => 'driver',
        'uses'  => 'DriverController@index',
        'roles' => ['driver'],
    ]);
}
);