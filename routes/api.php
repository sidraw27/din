<?php

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

Route::group(['prefix' => 'affiliate'], function() {
    Route::get('price/{hotelId}', [
        'uses' => 'Api\AffiliateController@getPrice'
    ]);
});

Route::group(['prefix' => 'search'], function () {
    Route::get('suggest/{string}', [
        'uses' => 'Api\SearchController@getSuggestion'
    ]);
});