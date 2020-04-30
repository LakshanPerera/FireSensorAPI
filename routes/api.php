<?php

use App\SensorInfo;
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
Route::post('/login', 'AuthLoginController@login')->name('api-login-route');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/get', function (){
   return \App\User::all()->toJson();
});

Route::resource("/sensorinfo", "SensorInfoController");

Route::get('/isregistered/{id}', 'SensorInfoController@isRegistered');

Route::middleware('auth:api')->put('/update/{sensor}', 'SensorInfoController@adminUpdate');
Route::middleware('auth:api')->post('/sensorinfo', 'SensorInfoController@store');
Route::middleware('auth:api')->delete('/sensorinfo/{sensor}', 'SensorInfoController@destroy');

