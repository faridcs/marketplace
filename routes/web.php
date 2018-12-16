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

Route::group(['namespace' => 'Web'], function () {

    Route::get('/', function () {
        return 'Marketplace ... !';
    });

    Route::group(['middleware' => ['auth']], function () {

    });

});

Route::pattern('slug', '[a-z0-9- _]+');