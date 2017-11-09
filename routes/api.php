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
Route::get('/city', 'API\\CityController@get_list');
Route::get('/city/price', 'API\\CityController@get_price');
Route::get('/weight', 'API\\WeightController@get_list');
