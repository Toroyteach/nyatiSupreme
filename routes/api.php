<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'API'], function () {
    Route::get('/register-url', 'MpesaController@register');
    Route::any('/mpesa/validate', 'MpesaController@validateTransaction');
    Route::any('/mpesa/confirm', 'MpesaController@confirmTransaction');
    
    Route::get('/fake-invoice', 'MpesaTestController@fakeInvoice');
    Route::get('/real-invoice', 'MpesaTestController@realInvoice');

    // Route::post('v1/access/token', function(Request $request) {
    //     return "accepted";
    // });
});


Route::post('v1/access/token', 'TestV1\MpesaControllerTest@generateAccessToken');
Route::post('v1/Nyati/stk/push', 'TestV1\MpesaControllerTest@customerMpesaSTKPush');

Route::group(['prefix' => 'v1', 'as' => 'api.mpesa.', 'namespace' => 'Mpesa'], function () {

    Route::group(['prefix' => 'c2b', 'as' => 'c2b.'], function () {
        Route::post('register', 'C2BController@register')->name('register');//creates request from the system
        Route::post('simulate', 'C2BController@simulate')->name('simulate');//creates request from the system
        Route::post('confirm/{confirmation_key}', 'C2BController@confirmTrx')->name('confirm');//receives from safaricom
        Route::post('validate/{validation_key}', 'C2BController@validateTrx')->name('validate');//receives from safaricom
    });

    Route::group(['prefix' => 'stk', 'as' => 'stk-push.'], function () {
        Route::post('simulate', 'STKPushController@simulate')->name('simulate');//creates the request from system
        Route::post('confirm/{confirmation_key}', 'STKPushController@confirm')->name('confirm');//receives from safaricom
    });
});
