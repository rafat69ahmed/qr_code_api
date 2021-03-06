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

Route::get('/user', function (Request $request) {
    // return "hello";
    return $request->user();
})->middleware('auth:api');


Route::group([ 'prefix' => 'v1' ], function(){
    // Get token using default user auth
    // Route::get('hello', 'HomeController@index');
    Route::get('/test', 'ProfileController@index');
    Route::delete('delete/user/{id}',   'ProfileController@userDelete');
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post( 'register', 'Auth\RegisterController@create' );

    Route::group([ 'middleware' => ['ValidToken'] ], function(){
        Route::get('user/{id?}', 'ProfileController@profile');
        Route::post('info/store', 'QrCodeController@store');
        Route::post('user/type', 'ProfileController@labooh');
        Route::get('home', 'QrCodeController@home');
        Route::get('merchant/promo', 'QrCodeController@promoList');
        Route::get('promolist/user', 'QrCodeController@userPromoList');
        Route::post('promolist/user/date', 'QrCodeController@userDateList');
        Route::post('promocode', 'QrCodeController@promoJustify');
        Route::post('date', 'QrCodeController@test');
    });
});