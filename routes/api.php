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
Route::get('/zzz', 'BirdSenderController@testMail');
Route::get('/reset_password', 'BirdSenderController@sendResetPasswordMail');
Route::post('/reset_password', 'API\\MailWebViewerController@doResetPassword');
Route::get('/messagetest', 'API\\MessageController@testMessage');
Route::post('/send_report', 'BirdSenderController@sendReportMail');
Route::get('/test/config', 'ConfigHunter@test');
Route::get('/cron/begin', 'UtilityController@cronjobBegin');
Route::get('/cron/end', 'UtilityController@cronjobEnd');
Route::get('/cron/set/on', 'UtilityController@startcronjob');
Route::get('/cron/set/off', 'UtilityController@stopcronjob');
Route::get('/fcmtest', 'FCMSender@testTopic');
Route::get('/smstest', 'SMSSender@testSMS');
Route::get('/scrapper_test/{booking_code}/{airport_code}/{date}/{first_name}/{last_name}', 'WebScrapper@testScrapper');
Route::get('/tes', 'API\\VMEController@getAll');


Route::get('/pesan/{id_user}', 'API\\MessageController@getPesan');
Route::get('/pesan/{id_user}/{id_pesan}', 'API\\MessageController@getPesanSpesifik');

// + Acknowledgement +
// dua method dibawah ini merepresentasikan proses yang sama,
// terdapat issue CORS pada web app jika menggunakan method DELETE
// sehingga dilakukan duplikasi path API untuk menghapus pesan
Route::delete('/pesan/{id_user}/{id_pesan}', 'API\\MessageController@hapusPesan');
Route::post('/pesan/{id_user}/{id_pesan}', 'API\\MessageController@hapusPesan');

Route::post('/register', 'API\\UserController@register');
Route::post('/verify/phone', 'API\\UserController@verifyPhoneNumber');
Route::post('/verify/resend', 'API\\UserController@resendSMSCode');
Route::post('/login', 'API\\UserController@login');
Route::post('/login/device', 'API\\UserController@deviceRegisterOrLogin');
Route::post('/login/fb', 'API\\UserController@actionFB');
Route::post('/login/twitter', 'API\\UserController@actionTwitter');

Route::get('/payment/bank', 'API\\PaymentController@bank_list');
Route::get('/payment', 'API\\PaymentController@list_type_payment');

Route::get('/city', 'API\\CityController@get_list');
Route::get('/city/price', 'API\\CityController@get_price');

Route::get('/goods/weight', 'API\\GoodsController@get_list_weight');
Route::get('/goods/price_estimate', 'API\\GoodsController@get_list_price_estimate');
Route::get('/goods/insurance', 'API\\GoodsController@get_insurance_price');
Route::get('/goods/price/{id_origin_city}/{id_destination_city}', 'API\\GoodsController@get_city_price_list');

Route::post('/shipment', 'API\\ShipmentController@submit');
Route::get('/shipment/status', 'API\\ShipmentController@get_status');
Route::get('/shipment/all_status', 'API\\ShipmentController@get_all_status_shipments');
Route::get('/shipment/all', 'API\\ShipmentController@get_all_shipment');
Route::post('/shipment/search', 'API\\ShipmentController@search_shipment');
Route::post('/shipment/cancel', 'API\\ShipmentController@cancel_shipment');

Route::get('/flight/booking', 'API\\FlightController@get_flight_booking');
Route::get('/flight/airport', 'API\\FlightController@get_airport_list');
Route::post('/flight/test', 'API\\FlightController@post_flight_booking_code');
Route::post('/flight/create_flight', 'API\\FlightController@post_flight_booking_code');
Route::get('/flight/booking/used', 'API\\FlightController@get_used_booking_code');
Route::get('/flight/booking/city', 'API\\FlightController@get_booking_code_by_city');
Route::post('/flight/check_flight_b_n_d', 'UtilityController@check_flight_b_n_d');
Route::get('/flight/code_check', 'API\\FlightController@flight_booking_code_check');

Route::get('/money/{id}', 'UtilityController@getMyMoney');

Route::post('/delivery', 'API\\DeliveryController@submit');
Route::get('/delivery/status', 'API\\DeliveryController@get_status');
Route::post('/delivery/confirm', 'API\\DeliveryController@confirm');
Route::post('/delivery/send_tag', 'API\\DeliveryController@send_tag');
Route::get('/delivery/all_status', 'API\\DeliveryController@get_all_status_delivery');
Route::post('/delivery/search', 'API\\DeliveryController@search_delivery');

Route::get('/home', 'API\\HomeController@list_of_shipment_and_delivery');

Route::get('/term', 'API\\TermConditionsController@index');

Route::get('/qrcode/{id}', 'Admin\\ShipmentPickUpAdminController@qrcode');
Route::get('/qrcodeDO/{id}', 'Admin\\ShipmentDropOffAdminController@qrcode');
Route::get('/qrcodeX', 'Admin\\ShipmentPickUpAdminController@createQR');

Route::post('/profile/update', 'API\\UserController@update_profile');

Route::get('/help', 'API\\HelpTipsterController@index');

Route::post('/report', 'API\\FeedbackController@submit');

Route::get('/location/province', 'API\\LocationController@getProvince');
Route::get('/location/city/{id_province}', 'API\\LocationController@getCity');
Route::get('/location/district/{id_city}', 'API\\LocationController@getDistrict');
Route::get('/location/airportcity', 'API\\CityController@get_airport_city_list');

Route::post('/worker/login', 'API\\Worker\\AuthController@login');
Route::get('/worker/delivery', 'API\\Worker\\DeliveryController@get_detail');
Route::post('/worker/delivery/departure', 'API\\Worker\\DeliveryController@departure');
Route::get('/worker/arrival', 'API\\Worker\\ArrivalController@get_list');
Route::post('/worker/arrival/confirm', 'API\\Worker\\ArrivalController@confirm');
Route::get('/worker/shipment', 'API\\Worker\\ShipmentController@get_detail');
Route::post('/worker/shipment', 'API\\Worker\\ShipmentController@pickup');
Route::post('/worker/shipment/confirm', 'API\\Worker\\ShipmentController@upload_signature');

Route::post('/payment/inquiry', 'API\\PaymentController@receiveInquiry');
Route::post('/payment/payment', 'API\\PaymentController@receivePaymentNotification');
Route::post('/transaction', 'API\\PaymentController@createTransaction');
Route::post('/payment/checkstatus', 'API\\PaymentController@checkPaymentStatus');
Route::post('/tespay', 'API\\PaymentController@tesEspayNotif');


Route::get('match/find_slot', 'UtilityController@cariSlot');
Route::get('match/find_shipment', 'UtilityController@cariShipment');
Route::get('match/find_shipment_slot_matched', 'UtilityController@cariShipmentSlotMatched');
Route::get('match/all_slot', 'UtilityController@allAvailableSlot');
Route::get('match/submit_matching', 'UtilityController@submitMatching');
Route::get('match/un_submit_matching', 'UtilityController@unSubmitMatching');
Route::get('match/posting_matching', 'UtilityController@postingMatching');

Route::get('/promo', 'API\\PromotionController@getPromo');
Route::get('iklan', 'UtilityController@tesIklan');

Route::post('promo', 'API\\PromotionController@postSelectPromo');
