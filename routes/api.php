<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/demo', 'UtilityController@test');
Route::get('/fcmtest', 'FCMSender@testTopic');

Route::post('/register', 'API\\UserController@register');
Route::post('/login', 'API\\UserController@login');
Route::get('/payment/bank', 'API\\PaymentController@bank_list');

Route::get('/city', 'API\\CityController@get_list');
Route::get('/city/price', 'API\\CityController@get_price');

Route::get('/goods/weight', 'API\\GoodsController@get_list_weight');
Route::get('/goods/price_estimate', 'API\\GoodsController@get_list_price_estimate');
Route::get('/goods/insurance', 'API\\GoodsController@get_insurance_price');

Route::post('/shipment', 'API\\ShipmentController@submit');
Route::get('/shipment/status', 'API\\ShipmentController@get_status');

Route::get('/flight/booking', 'API\\FlightController@get_flight_booking');

Route::post('/delivery', 'API\\DeliveryController@submit');
Route::get('/delivery/status', 'API\\DeliveryController@get_status');
Route::post('/delivery/confirm', 'API\\DeliveryController@confirm');
Route::post('/delivery/send_tag', 'API\\DeliveryController@send_tag');

Route::get('/home', 'API\\HomeController@list_of_shipment_and_delivery');

Route::post('/worker/login', 'API\\Worker\\AuthController@login');