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
Route::get('/smstest', 'SMSSender@testSMS');

Route::post('/register', 'API\\UserController@register');
Route::post('/verify/phone', 'API\\UserController@verifyPhoneNumber');
Route::post('/verify/resend', 'API\\UserController@resendSMSCode');
Route::post('/login', 'API\\UserController@login');
Route::post('/login/fb', 'API\\UserController@actionFB');
Route::post('/login/twitter', 'API\\UserController@actionTwitter');

Route::get('/payment/bank', 'API\\PaymentController@bank_list');
Route::get('/payment', 'API\\PaymentController@list_type_payment');

Route::get('/city', 'API\\CityController@get_list');
Route::get('/city/price', 'API\\CityController@get_price');

Route::get('/goods/weight', 'API\\GoodsController@get_list_weight');
Route::get('/goods/price_estimate', 'API\\GoodsController@get_list_price_estimate');
Route::get('/goods/insurance', 'API\\GoodsController@get_insurance_price');

Route::post('/shipment', 'API\\ShipmentController@submit');
Route::get('/shipment/status', 'API\\ShipmentController@get_status');

Route::get('/flight/booking', 'API\\FlightController@get_flight_booking');
Route::get('/flight/booking/used', 'API\\FlightController@get_used_booking_code');
Route::get('/flight/booking/city', 'API\\FlightController@get_booking_code_by_city');

Route::post('/delivery', 'API\\DeliveryController@submit');
Route::get('/delivery/status', 'API\\DeliveryController@get_status');
Route::post('/delivery/confirm', 'API\\DeliveryController@confirm');
Route::post('/delivery/send_tag', 'API\\DeliveryController@send_tag');

Route::get('/home', 'API\\HomeController@list_of_shipment_and_delivery');

Route::get('/term', 'API\\TermConditionsController@index');

Route::post('/profile/update', 'API\\UserController@update_profile');

Route::get('/help', 'API\\HelpTipsterController@index');

Route::get('/location/province', 'API\\LocationController@getProvince');
Route::get('/location/city/{id_province}', 'API\\LocationController@getCity');
Route::get('/location/district/{id_city}', 'API\\LocationController@getDistrict');

Route::post('/worker/login', 'API\\Worker\\AuthController@login');
Route::get('/worker/delivery', 'API\\Worker\\DeliveryController@get_detail');
Route::post('/worker/delivery/departure', 'API\\Worker\\DeliveryController@departure');
Route::get('/worker/arrival', 'API\\Worker\\ArrivalController@get_list');
Route::post('/worker/arrival/confirm', 'API\\Worker\\ArrivalController@confirm');

Route::post('/payment/inquiry', 'API\\PaymentController@receiveInquiry');
Route::post('/payment/payment', 'API\\PaymentController@receivePaymentNotification');
Route::post('/transaction', 'API\\PaymentController@createTransaction');
Route::post('/payment/checkstatus', 'API\\PaymentController@checkPaymentStatus');
Route::post('/tespay', 'API\\PaymentController@tesEspayNotif');

