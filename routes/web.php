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

Route::get('/', function() {
    var_dump(\Auth::check());
})->name('index');

Route::get('hotel/{id}', [
    'uses' => 'HotelController@index',
    'as'   => 'hotel'
])->where('id', '[a-zA-Z0-9]{6}');

Route::group(['prefix' => 'auth'], function() {
    Route::get('authentication/{provider}', [
        'uses' => 'AuthController@authentication',
        'as'   => 'auth.login'
    ]);
    Route::get('callback/{provider}', [
        'uses' => 'AuthController@callback',
        'as'   => 'auth.callback'
    ]);
    Route::get('logout', [
        'uses' => 'AuthController@logout',
        'as'   => 'logout'
    ]);
});