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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getmadinahotels', 'HomeController@getHotelsMadina');

Route::get('getmekkahhotels', 'HomeController@getHotelsMekkah');
Route::get('getvillages', 'HomeController@getVillages');
Route::get('getvisastypes', 'HomeController@getVisas');
Route::get('getcars', 'HomeController@getCars');

Route::post('bookingtachira', 'HomeController@bookingTachira');
Route::post('bookingmorchid', 'HomeController@bookingMorchid');
Route::post('bookingomrah', 'HomeController@bookingOmrah');
Route::get('getmazarat', 'HomeController@getMazarat');
Route::get('getnusuk', 'HomeController@getNusuk');




