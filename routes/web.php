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

Route::prefix('admin')->group(function () {
    Auth::routes();
    Route::group( ['middleware' => 'auth' ], function()
    {
        Route::get('/', function () {
            return view('admin.dashboard');
        });
        Route::resource('countrylists','Admin\CountryListAdminController');
        Route::resource('roles','Admin\RoleAdminController');
        Route::resource('users','Admin\UserAdminController');
        Route::resource('airlineslists','Admin\AirlinesListAdminController');
        Route::resource('officetypes','Admin\OfficeTypeAdminController');
    });
    
    
});
