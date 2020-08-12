<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pledge', 'PledgeController@pledge_landing');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('device', 'DeviceController');
Route::resource('org', 'OrgController');
Route::resource('user', 'UserController');
