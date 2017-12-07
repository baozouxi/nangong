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


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//以下路由要经过auth中间件

Route::group(['middleware' => 'auth'], function () {


    Route::group(['prefix' => '/account'], function () {
        Route::get('/user', 'AccountsController@user')->name('account.user');
        Route::get('/recharge', 'AccountsController@recharge')->name('account.recharge');
        Route::get('/capital-log', 'AccountsController@capitalLog')->name('account.capital_log');
        Route::get('/agency', 'AccountsController@agency')->name('account.agency');
        Route::get('/safe', 'AccountsController@safe')->name('account.safe');
    });


    Route::group(['prefix' => '/game'], function () {
        Route::get('/last-open-codes', 'GamesController@getLastCodes')->name('lastOpenCodes');
        Route::get('/last-open-codes-list', 'GamesController@getLastCodeList')->name('lastOpenCodeList');
        Route::get('/open-time', 'GamesController@getOpenTime')->name('openTime'); //开奖时间
        Route::get('/pc28', 'GamesController@pc28')->name('pc28');
    });

});

