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

Route::prefix('/')->name('auth.')->group(function () {
    Route::get('/', 'AuthController@index')->name('form');
    Route::post('/', 'AuthController@doLogin')->name('login');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/img-captcha', 'AuthController@generateImageCaptcha')->name('img-captcha');
});
