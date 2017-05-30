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
    Route::get('hello', 'HomeController@index');
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post( 'register', 'Auth\RegisterController@create' );
    Route::get('user/{id?}', 'ProfileController@profile');
    Route::post('info/store', 'QrCodeController@store');
    Route::get('home', 'QrCodeController@home');
});