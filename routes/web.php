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
        Route::group(['middleware' => ['permission:citylists.']], function () {
            Route::resource('citylists','Admin\CityListAdminController');
        });
        Route::group(['middleware' => ['permission:airlineslists.']], function () {
            Route::resource('airlineslists','Admin\AirlinesListAdminController');
        });

        Route::group(['middleware' => ['permission:airportlists.']], function () {
            Route::resource('airportlists','Admin\AirportListAdminController');
            Route::get('airportlists/{airportlist}/create', 'Admin\AirportCityScopeAdminController@create')->name('airportcityscopes.create');
            Route::post('airportlists/{airportlist}/create', 'Admin\AirportCityScopeAdminController@store')->name('airportcityscopes.store');
            Route::get('airportlists/{airportlist}/{airportcityscope}/edit', 'Admin\AirportCityScopeAdminController@edit')->name('airportcityscopes.edit');
            Route::put('airportlists/{airportlist}/{airportcityscope}/edit', 'Admin\AirportCityScopeAdminController@update')->name('airportcityscopes.update');
            Route::delete('airportlists/{airportlist}/{airportcityscope}', 'Admin\AirportCityScopeAdminController@destroy')->name('airportcityscopes.destroy');
        });
        Route::group(['middleware' => ['permission:officetypes.']], function () {
            Route::resource('officetypes','Admin\OfficeTypeAdminController');
        });
        Route::group(['middleware' => ['permission:officelists.']], function () {
            Route::resource('officelists','Admin\OfficeListAdminController');
            Route::get('officelists/{officelist}/create', 'Admin\OfficeDropPointAdminController@create')->name('officedroppoints.create');
            Route::post('officelists/{officelist}/create', 'Admin\OfficeDropPointAdminController@store')->name('officedroppoints.store');
            Route::get('officelists/{officelist}/{officedroppoint}/edit', 'Admin\OfficeDropPointAdminController@edit')->name('officedroppoints.edit');
            Route::put('officelists/{officelist}/{officedroppoint}/edit', 'Admin\OfficeDropPointAdminController@update')->name('officedroppoints.update');
            Route::delete('officelists/{officelist}/{officedroppoint}', 'Admin\OfficeDropPointAdminController@destroy')->name('officedroppoints.destroy');
        });
        Route::group(['middleware' => ['permission:banklists.']], function () {
            Route::resource('banklists','Admin\BankListAdminController');        
            Route::get('banklists/{banklist}/create', 'Admin\BankCardListAdminController@create')->name('bankcardlists.create');
            Route::post('banklists/{banklist}/create', 'Admin\BankCardListAdminController@store')->name('bankcardlists.store');
            Route::get('banklists/{banklist}/{bankcard}/edit', 'Admin\BankCardListAdminController@edit')->name('bankcardlists.edit');
            Route::put('banklists/{banklist}/{bankcard}/edit', 'Admin\BankCardListAdminController@update')->name('bankcardlists.update');
            Route::delete('banklists/{banklist}/{bankcard}', 'Admin\BankCardListAdminController@destroy')->name('bankcardlists.destroy');
        });
        Route::group(['middleware' => ['permission:paymenttypes.']], function () {
            Route::resource('paymenttypes','Admin\PaymentTypeAdminController');
        });

        Route::group(['middleware' => ['permission:pricelists.']], function () {
            Route::resource('pricelists','Admin\PriceListAdminController');
        });

        Route::group(['middleware' => ['permission:memberlists.']], function () {
            Route::resource('memberlists','Admin\MemberListAdminController');
        });

        Route::group(['middleware' => ['permission:insurances.']], function () {
            Route::resource('insurances','Admin\InsuranceAdminController');
        });
        
        Route::group(['middleware' => ['permission:weightlists.']], function () {
            Route::resource('weightlists','Admin\WeightListAdminController');
        });
        Route::group(['middleware' => ['permission:shipments.']], function () {
            Route::resource('shipments','Admin\ShipmentAdminController');
        });
        Route::group(['middleware' => ['permission:slotlists.']], function () {
            Route::resource('slotlists','Admin\SlotListAdminController');
        });

        Route::group(['middleware' => ['permission:deliveries.']], function () {
            Route::resource('deliveries','Admin\DeliveryAdminController');
        });

        Route::group(['middleware' => ['permission:receiveds.']], function () {
            Route::resource('receiveds','Admin\ReceivedAdminController');
        });

        Route::group(['middleware' => ['permission:receiveds.']], function () {
            Route::resource('shipmenttrackings','Admin\ShipmentTrackingAdminController');
        });

        Route::group(['middleware' => ['permission:shipmentstatuses.']], function () {
            Route::resource('shipmentstatuses','Admin\ShipmentStatusAdminController');
        });
        Route::group(['middleware' => ['permission:users.']], function () {
            Route::resource('users','Admin\UserAdminController');
        });

        Route::group(['middleware' => ['permission:roles.']], function () {
            Route::resource('roles','Admin\RoleAdminController');
        });

        Route::group(['middleware' => ['permission:permissions.']], function () {
            Route::resource('permissions','Admin\PermissionAdminController');
        });

        Route::resource('suddenfuckingshits', 'Admin\SuddenFuckingShitController');
    });
    
    
});
