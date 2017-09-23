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



Route::group(['middleware' => ['auth','roles'], 'prefix' => 'admin'], function ()
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
                ])->name('create-user');

        Route::post('/create-user',  [
            'as'    => 'create-user',
            'uses'  => 'AdminController@storeUser',
            'roles' => ['admin'],
        ]);

    }
);

Route::group(['middleware' => ['auth','roles'], 'prefix' => 'manager'], function ()
    {
        Route::get('/', [
            'as'    => 'manager',
            'uses'  => 'ManagerController@index',
            'roles' => ['manager'],
            ]);
    }
);

Route::group(['middleware' => ['auth','roles'], 'prefix' => 'driver'], function ()
{
    Route::get('/', [
        'as'    => 'driver',
        'uses'  => 'DriverController@index',
        'roles' => ['driver'],
    ]);
}
);

Route::group(['middleware' => ['auth','roles'], 'prefix' => 'customer'], function ()
{
    Route::get('/', [
        'as'    => 'customer',
        'uses'  => 'CustomerController@index',
        'roles' =>  ['customer'],
        ]);
}
);