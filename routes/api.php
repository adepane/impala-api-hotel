<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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
// get query by params hotels
Route::get('/hotels', function(Request $request) {
    $response = Http::withHeaders([
        'x-api-key' => config('app.impala_api'),
    ])->get('https://sandbox.impala.travel/v1/hotels?'.http_build_query($request->all()));
    $theResponse = $response->getBody()->getContents();
    $return = str_replace('https://sandbox.impala.travel/v1/', '/', $theResponse);
    return json_decode($return, true);
});

// get query by hotelId
Route::get('/hotels/{hotelId}', function($hotelId, Request $request) {
    $response = Http::withHeaders([
        'x-api-key' => config('app.impala_api'),
    ])->get('https://sandbox.impala.travel/v1/'.$params."/".$hotelId);
    return $response->json();
});

//get Rates by hotelId
Route::get('/hotels/{hotelId}/rate-plans', function($hotelId, Request $request) {
    $response = Http::withHeaders([
        'x-api-key' => config('app.impala_api'),
    ])->get('https://sandbox.impala.travel/v1/hotels/'.$hotelId.'/rate-plans');
    return $response->json();
});