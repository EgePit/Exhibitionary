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

Route::post('signup', 'Auth\ApiAuthController@register');
Route::post('login', 'Auth\ApiAuthController@login');
Route::middleware('jwt.refresh')->get('/token/refresh', 'Auth\ApiAuthControlle@refresh');

Route::group(['prefix' => 'editors'], function() {
    Route::get('/get-by-city', 'Api\EditorsController@get_by_city');
});

Route::group(['prefix' => 'districts'], function() {
    Route::get('/get-by-city', 'Api\DistrictsController@get_by_city');
});

Route::group(['prefix' => 'institutions'], function() {
    Route::get('/get-by-city', 'Api\InstitutionsController@get_by_city');
});

Route::group(['prefix' => 'cities'], function() {
    Route::get('/get-list', 'Api\CitiesController@get_list');
});

