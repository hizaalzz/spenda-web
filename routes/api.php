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

Route::post('/login', 'Auth\ApiAuthController@login')->name('api.auth.login');

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function() {
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('api.auth.logout');
    Route::post('/logoutall', 'Auth\ApiAuthController@logoutAll')->name('api.auth.logoutall');
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('/pengumuman', 'Api\RestPengumumanController')->only(['index', 'show']);
});
