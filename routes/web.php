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
        Route::resource('citylists','Admin\CityListAdminController');

        Route::resource('airlineslists','Admin\AirlinesListAdminController');

        Route::resource('airportlists','Admin\AirportListAdminController');
        Route::get('airportlists/{airportlist}/create', 'Admin\AirportCityScopeAdminController@create')->name('airportcityscopes.create');
        Route::post('airportlists/{airportlist}/create', 'Admin\AirportCityScopeAdminController@store')->name('airportcityscopes.store');
        Route::get('airportlists/{airportlist}/{airportcityscope}/edit', 'Admin\AirportCityScopeAdminController@edit')->name('airportcityscopes.edit');
        Route::put('airportlists/{airportlist}/{airportcityscope}/edit', 'Admin\AirportCityScopeAdminController@update')->name('airportcityscopes.update');
        Route::delete('airportlists/{airportlist}/{airportcityscope}', 'Admin\AirportCityScopeAdminController@destroy')->name('airportcityscopes.destroy');

        Route::resource('officetypes','Admin\OfficeTypeAdminController');
        Route::resource('officelists','Admin\OfficeListAdminController');
        Route::get('officelists/{officelist}/create', 'Admin\OfficeDropPointAdminController@create')->name('officedroppoints.create');
        Route::post('officelists/{officelist}/create', 'Admin\OfficeDropPointAdminController@store')->name('officedroppoints.store');
        Route::get('officelists/{officelist}/{officedroppoint}/edit', 'Admin\OfficeDropPointAdminController@edit')->name('officedroppoints.edit');
        Route::put('officelists/{officelist}/{officedroppoint}/edit', 'Admin\OfficeDropPointAdminController@update')->name('officedroppoints.update');
        Route::delete('officelists/{officelist}/{officedroppoint}', 'Admin\OfficeDropPointAdminController@destroy')->name('officedroppoints.destroy');

        Route::resource('banklists','Admin\BankListAdminController');        
        Route::get('banklists/{banklist}/create', 'Admin\BankCardListAdminController@create')->name('bankcardlists.create');
        Route::post('banklists/{banklist}/create', 'Admin\BankCardListAdminController@store')->name('bankcardlists.store');
        Route::get('banklists/{banklist}/{bankcard}/edit', 'Admin\BankCardListAdminController@edit')->name('bankcardlists.edit');
        Route::put('banklists/{banklist}/{bankcard}/edit', 'Admin\BankCardListAdminController@update')->name('bankcardlists.update');
        Route::delete('banklists/{banklist}/{bankcard}', 'Admin\BankCardListAdminController@destroy')->name('bankcardlists.destroy');

        Route::resource('paymenttypes','Admin\PaymentTypeAdminController');

        Route::resource('goodscategories','Admin\GoodsCategoryAdminController');

        Route::resource('pricelists','Admin\PriceListAdminController');

        Route::resource('roles','Admin\RoleAdminController');
        Route::resource('users','Admin\UserAdminController');
        
    });
    
    
});
