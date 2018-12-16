<?php

use Illuminate\Routing\Router;

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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function (Router $router) {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1', 'as' => 'v1.'], function (Router $router) {

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');

        Route::group(['middleware' => ['jwt.auth']], function (Router $router) {

            Route::get('logout', 'AuthController@logout');

            Route::get('test', function() {
               return response()->json(['foo'=>'bar']);
            });

            Route::prefix('user')->group(function () {
               Route::get('/', 'UserController@getUserByUserName');
               Route::get('{id}', 'UserController@getUserById');
            });
        });

    });
});