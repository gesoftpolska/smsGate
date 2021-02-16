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


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('test','FrontendController@get_test');

Route::get('ziom','FrontendController@get_php_client_socket');

Route::group(['middleware' => ['auth']],function (){

    Route::get('/', 'FrontendController@get_root_page');
    Route::get('get_api_page', 'FrontendController@get_api_page');
    Route::get('create_sms_form', 'FrontendController@get_view_send_one_sms');


    Route::get('/home', 'HomeController@index')->name('home');



    Route::post('create_sms','BackendController@createSMS');

});




Auth::routes(['register' => false]);


