<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AppUserAuthController@login')->name('login');
    Route::post('register', 'AppUserAuthController@register');
    Route::group(['middleware' => ['api', 'multiauth:appusers']], function() {
        Route::get('logout', 'AppUserAuthController@logout');
        Route::get('user', 'AppUserAuthController@user');
    });
});

//Route::get('/balance', 'BalanceController@get_user_balance')->middleware(['api', 'multiauth:appusers']);

Route::get('/device/{device_hash}/{org_hash}', 'DeviceController@get_device')->middleware(['api', 'multiauth:appusers']);

Route::get('/donations', 'DonationController@get_user_donations')->middleware(['api', 'multiauth:appusers']);

Route::post('/donations', 'DonationController@donate')->middleware(['api', 'multiauth:appusers']);
