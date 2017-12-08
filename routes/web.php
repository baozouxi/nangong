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
        Route::get('/user', 'AccountsController@user')->name('account.user'); //个人中心
        Route::get('/recharge', 'AccountsController@recharge')->name('account.recharge'); //充值
        Route::get('/withdraw', 'AccountsController@withdraw')->name('account.withdraw'); //提现
        Route::get('/capital-log', 'AccountsController@capitalLog')->name('account.capital_log'); //财务记录
        Route::get('/agency', 'AccountsController@agency')->name('account.agency'); //代理中心
        Route::get('/safe', 'AccountsController@safe')->name('account.safe'); // 安全中心
    });


    Route::group(['prefix' => '/game'], function () {
        Route::get('/last-open-codes', 'GamesController@getLastCodes')->name('lastOpenCodes');
        Route::get('/last-open-codes-list', 'GamesController@getLastCodeList')->name('lastOpenCodeList');
        Route::get('/last10', 'GamesController@getLast10')->name('last10');
        Route::get('/open-time', 'GamesController@getOpenTime')->name('openTime'); //开奖时间
        Route::get('/pc28', 'GamesController@pc28')->name('pc28');
    });

});

