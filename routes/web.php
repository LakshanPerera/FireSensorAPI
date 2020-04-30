<?php

use Illuminate\Support\Facades\Route;

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
//Route::post('/login', 'AuthLoginController@login')->name('api-login-route');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::match(['get', 'post'], 'login', function(){
    return redirect('/');
});
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});
Route::get('/home', 'HomeController@index')->name('home');
