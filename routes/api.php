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
    Route::get('/register-url', 'MPesaController@register');
    Route::any('/mpesa/validate', 'MPesaController@validateTransaction');
    Route::any('/mpesa/confirm', 'MPesaController@confirmTransaction');
    
    Route::get('/fake-invoice', 'MPesaTestController@fakeInvoice');
    Route::get('/real-invoice', 'MPesaTestController@realInvoice');
});
