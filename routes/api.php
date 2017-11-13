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

Route::post('/register', 'API\\UserController@register');
Route::post('/login', 'API\\UserController@login');
Route::get('/payment/bank', 'API\\PaymentController@bank_list');

Route::get('/city', 'API\\CityController@get_list');
Route::get('/city/price', 'API\\CityController@get_price');

Route::get('/goods/weight', 'API\\GoodsController@get_list_weight');
Route::get('/goods/price_estimate', 'API\\GoodsController@get_list_price_estimate');
Route::get('/goods/insurance', 'API\\GoodsController@get_insurance_price');
