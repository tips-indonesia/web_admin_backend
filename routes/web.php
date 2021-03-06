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
// Route::get('/admin/tipsterpayments', 'Admin\TipsterPaymentController@index');

Route::get('/payment/start', 'API\\PaymentController@startPayment');
Route::get('/payment/status/get', 'API\\PaymentController@checkIfPaymentHasIssued');
Route::get('/v2/payment/start', 'API\\PaymentController@startPaymentV2');
Route::get('/reset_password/{token}', 'API\\MailWebViewerController@showResetPassword');

Route::prefix('admin/')->group(function ($locale) {
    Auth::routes();
Route::group(['middleware' => 'officename'], function() {
Route::group(['middleware' => 'isWorker'], function() {    
    Route::group( ['middleware' => 'auth' ], function()
    {
        Route::get('/', function () {
            return view('admin.dashboard');
        });

        Route::group(['middleware' => ['permission:citylists.']], function () {
            Route::resource('citylists','Admin\CityListAdminController');
        });
        Route::group(['middleware' => ['permission:duallanguage.']], function () {
            Route::resource('duallanguage','Admin\DualLanguageAdminController');
        });
        Route::group(['middleware' => ['permission:provincelists.']], function () {
            Route::resource('provincelists','Admin\ProvinceListAdminController');
        });
        Route::group(['middleware' => ['permission:subdistrictlists.']], function () {
            Route::resource('subdistrictlists','Admin\SubdistrictListAdminController');
        });

        Route::group(['middleware' => ['permission:airlineslists.']], function () {
            Route::resource('airlineslists','Admin\AirlinesListAdminController');
        });

        Route::group(['middleware' => ['permission:airportlists.']], function () {
            Route::resource('airportlists','Admin\AirportListAdminController');
        });
        Route::group(['middleware' => ['permission:airportcitylists.']], function () {
            Route::resource('airportcitylists','Admin\AirportcityListAdminController');
        });
        Route::group(['middleware' => ['permission:officetypes.']], function () {
            Route::resource('officetypes','Admin\OfficeTypeAdminController');
        });
        Route::group(['middleware' => ['permission:officelists.']], function () {
            Route::resource('officelists','Admin\OfficeListAdminController');
            Route::get('officelists/{officelist}/droppoints', 'Admin\OfficeDropPointAdminController@show')->name('officedroppoints.show');
            Route::get('officelists/{officelist}/droppoints/create', 'Admin\OfficeDropPointAdminController@create')->name('officedroppoints.create');
            Route::post('officelists/{officelist}/droppoints/create', 'Admin\OfficeDropPointAdminController@store')->name('officedroppoints.store');
            Route::get('officelists/{officelist}/droppoints/{officedroppoint}/edit', 'Admin\OfficeDropPointAdminController@edit')->name('officedroppoints.edit');
            Route::put('officelists/{officelist}/droppoints/{officedroppoint}/edit', 'Admin\OfficeDropPointAdminController@update')->name('officedroppoints.update');
            Route::delete('officelists/{officelist}/droppoints/{officedroppoint}', 'Admin\OfficeDropPointAdminController@destroy')->name('officedroppoints.destroy');

            Route::get('officelists/{officelist}/airports', 'Admin\OfficeAirportAdminController@show')->name('officeairports.show');
            Route::get('officelists/{officelist}/airports/create', 'Admin\OfficeAirportAdminController@create')->name('officeairports.create');
            Route::post('officelists/{officelist}/airports/create', 'Admin\OfficeAirportAdminController@store')->name('officeairports.store');
            Route::get('officelists/{officelist}/airports/{officedroppoint}/edit', 'Admin\OfficeAirportAdminController@edit')->name('officeairports.edit');
            Route::put('officelists/{officelist}/airports/{officedroppoint}/edit', 'Admin\OfficeAirportAdminController@update')->name('officeairports.update');
            Route::delete('officelists/{officelist}/airports/{officedroppoint}', 'Admin\OfficeAirportAdminControlfler@destroy')->name('officeairports.destroy');
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

        Route::group(['middleware' => ['permission:shipmentmatchingmonitors.']], function () {
            Route::resource('shipmentmatchingmonitors','Admin\ShipmentMatchingMonitorAdminController');
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
        Route::group(['middleware' => ['permission:slotcancellation.']], function () {
            Route::resource('slotcancellation','Admin\SlotCancellationAdminController');
        });
        Route::group(['middleware' => ['permission:packagingslots.']], function () {
            Route::resource('packagingslots','Admin\PackagingSlotAdminController');
        });

        Route::group(['middleware' => ['permission:packagingprocessingcenters.']], function () {
            Route::resource('packagingprocessingcenters','Admin\PackagingProcessingCenterAdminController');
        });

        Route::group(['middleware' => ['permission:deliveries.']], function () {
            Route::resource('deliveries','Admin\DeliveryAdminController');
        });

        Route::group(['middleware' => ['permission:deliveryshipment.']], function () {
            Route::resource('deliveryshipment','Admin\DeliveryShipmentAdminController');
        });

        Route::group(['middleware' => ['permission:receiveds.']], function () {
            Route::resource('receiveds','Admin\ReceivedAdminController');
        });

        Route::group(['middleware' => ['permission:shipmenttrackings.']], function () {
            Route::resource('shipmenttrackings','Admin\ShipmentTrackingAdminController');
        });

        Route::group(['middleware' => ['permission:tipsterpayments.']], function () {
            Route::resource('tipsterpayments','Admin\TipsterPaymentController');
        });

        Route::group(['middleware' => ['permission:shipmentpickups.']], function () {
            Route::resource('shipmentpickups','Admin\ShipmentPickUpAdminController');
        });

        Route::group(['middleware' => ['permission:pendingarrivalcounters.']], function () {
            Route::resource('pendingarrivalcounters','Admin\PendingArrivalCounterAdminController');
        });

        Route::group(['middleware' => ['permission:pendingdeparturecounters.']], function () {
            Route::resource('pendingdeparturecounters','Admin\PendingDepartureCounterAdminController');
        });

        Route::group(['middleware' => ['permission:deliverydeparturecounters.']], function () {
            Route::resource('deliverydeparturecounters','Admin\DeliveryDepartureCounterAdminController');
        });

        Route::group(['middleware' => ['permission:deliveryprocessingcenters.']], function () {
            Route::resource('deliveryprocessingcenters','Admin\DeliveryProcessingCenterAdminController');
        });

        Route::group(['middleware' => ['permission:manualredeem.']], function () {
            Route::resource('manualredeem','Admin\ManualRedeemAdminController');
        });

        Route::group(['middleware' => ['permission:receiveprocessingcenters.']], function () {
            Route::resource('receiveprocessingcenters','Admin\ReceiveProcessingCenterAdminController');
        });

        Route::group(['middleware' => ['permission:shipmentdropoffs.']], function () {
            Route::resource('shipmentdropoffs','Admin\ShipmentDropOffAdminController');
        });

        Route::group(['middleware' => ['permission:receivedarrivalprocessingcenter.']], function () {
            Route::resource('receivedarrivalprocessingcenter','Admin\ReceivedArrivalProcessingCenterAdminController');
        });

        Route::group(['middleware' => ['permission:shipmentcancellation.']], function () {
            Route::resource('shipmentcancellation','Admin\ShipmentCancellationAdminController');
        });

        Route::group(['middleware' => ['permission:packagingdemolition.']], function () {
            Route::resource('packagingdemolition','Admin\PackagingDemolitionAdminController');
        });

        Route::group(['middleware' => ['permission:shipmentrejection.']], function () {
            Route::resource('shipmentrejection','Admin\ShipmentRejectionAdminController');
        });

        Route::group(['middleware' => ['permission:shipmentrejectiondelivery.']], function () {
            Route::resource('shipmentrejectiondelivery','Admin\ShipmentRejectionDeliveryAdminController');
        });
        
        Route::group(['middleware' => ['permission:slotrejection.']], function () {
            Route::resource('slotrejection','Admin\SlotRejectionAdminController');
        });

        Route::group(['middleware' => ['permission:printpickedupshipmentmanifest.']], function () {
            Route::resource('printpickedupshipmentmanifest','Admin\PrintPickedUpShipmentManifestAdminController');
        });

        Route::group(['middleware' => ['permission:shipmentstatuses.']], function () {
            Route::resource('shipmentstatuses','Admin\ShipmentStatusAdminController');
        });

        Route::group(['middleware' => ['permission:terms.']], function () {
            Route::resource('terms','Admin\TermAdminController');
        });
        
        Route::group(['middleware' => ['permission:match.']], function () {
            Route::resource('match','Admin\MatchTest');
        });

        Route::group(['middleware' => ['permission:users.']], function () {
            Route::resource('users','Admin\UserAdminController');
        });

        Route::group(['middleware' => ['permission:users.']], function () {
            Route::resource('debugs','Admin\DebugAdminController');
        });

        Route::group(['middleware' => ['permission:roles.']], function () {
            Route::resource('roles','Admin\RoleAdminController');
        });
        
        Route::group(['middleware' => ['permission:backups.']], function () {
            Route::resource('backups','Admin\BackupAdminController');
        });

        Route::group(['middleware' => ['permission:permissions.']], function () {
            Route::resource('permissions','Admin\PermissionAdminController');
        });

        Route::group(['middleware' => ['permission:packagingrestshipments.']], function () {
            Route::resource('packagingrestshipments','Admin\PackagingRestShipmentAdminController');
        });

        Route::group(['middleware' => ['permission:tipstermilestones.']], function () {
            Route::resource('tipstermilestones','Admin\TipsterMilestoneAdminController');
        });

        Route::group(['middleware' => ['permission:promotions.']], function () {
            Route::resource('promotions','Admin\PromotionController');
        });

        Route::group(['middleware' => ['permission:banner.']], function () {
            Route::resource('banner','Admin\BannerController');
        });

        Route::group(['middleware' => ['permission:referral.']], function () {
            Route::resource('referral','Admin\ReferralController');
        });

        Route::group(['middleware' => ['permission:crontimer.']], function () {
            Route::resource('crontimer','Admin\CronTimerController');
        });

        Route::group(['middleware' => ['permission:promotiontext.']], function () {
            Route::resource('promotiontext','Admin\PromotionTextController');
        });

        Route::group(['middleware' => ['permission:addworkerability.']], function () {
            Route::resource('addworkerability','Admin\AddWorkerAbilityController');
        });

        Route::group(['middleware' => ['permission:redeem.']], function () {
            Route::resource('redeem','Admin\RedeemController');
        });

        Route::resource('statuschangers','Admin\StatusChangerAdminController');
        
    });
   }); 
    });
});
