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
Route::get('{params}', function($params, Request $request) {
    $response = Http::withHeaders([
        'x-api-key' => config('app.impala_api'),
    ])->get('https://sandbox.impala.travel/v1/'.$params."?".http_build_query($request->all()));
    $theResponse = $response->getBody()->getContents();
    $tempResponse = str_replace('https://sandbox.impala.travel/v1/', '/', $theResponse);
    return json_decode($tempResponse, true);
});