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

Route::any('create_sms', 'BackendController@createSMS_api');
Route::get('get_created_list', 'BackendController@getListOfSmsToSend');
Route::get('update_status', 'BackendController@updateSmsStatus');
