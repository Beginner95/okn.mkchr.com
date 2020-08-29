<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index');
Route::resource('okn', 'OknController');
Route::get('/autocomplete-complex', 'ComplexController@autocompleteComplex');
Route::resource('complex', 'ComplexController');
Route::get('/autocomplete-district', 'DistrictController@autocompleteDistrict');
Route::resource('district', 'DistrictController');

Route::group(['namespace' => 'Auth'], function() {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'can:administrator']
], function () {
//Route::get('/', 'IndexController@index')->name('index');
//Route::get('route/autocomplete', 'RouteController@autocomplete')->name('route.autocomplete');
});

Auth::routes();
