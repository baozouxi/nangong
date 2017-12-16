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
        Route::patch('/password', 'AccountsController@changePass')->name('account.changePass');
        Route::patch('/money-password', 'AccountsController@changeMoneyPass')->name('account.changeMoneyPass');
        Route::get('/user', 'AccountsController@user')->name('account.user'); //个人中心
        Route::get('/money-logs', 'AccountsController@logs')->name('account.logs'); //财务变动
        Route::get('/user-info', 'AccountsController@userInfo')->name('account.userInfo'); //个人信息
        Route::get('/recharge', 'AccountsController@recharge')->name('account.recharge'); //充值
        Route::get('/withdraw', 'AccountsController@withdraw')->name('account.withdraw'); //提现
        Route::get('/capital-log', 'AccountsController@capitalLog')->name('account.capital_log'); //财务记录
        Route::get('/agency', 'AccountsController@agency')->name('account.agency'); //代理中心
        Route::get('/safe', 'AccountsController@safe')->name('account.safe'); // 安全中心
        Route::get('/money', 'AccountsController@money')->name('account.money'); // 账户余额
        Route::post('/bank-name', 'AccountsController@addBankName')->name('account.addBankName');//添加银行用户名
        Route::get('/cards', 'AccountsController@getCards')->name('account.getCards');//获取用户绑定的银行列表
        Route::post('/cards', 'AccountsController@addCards')->name('account.addCards'); //添加银行账号
    });

    Route::group(['prefix' => '/team'], function () {
        Route::get('/index','TeamsController@index')->name('team.index');//团队总览
        Route::get('/manager','TeamsController@manager')->name('team.manager');//团队管理
        Route::get('/total-data','TeamsController@loadTotalData')->name('team.loadTotalData');//团队数据
        Route::get('/load-manager','TeamsController@loadManager')->name('team.loadManager');//团队管理数据
        Route::get('/popularize','TeamsController@popularize')->name('team.popularize'); //推广
    });




    Route::group(['prefix' => '/game'], function () {

        Route::get('/{game}/last-open-codes/{expect}', 'GamesController@getLastCodes')->name('lastOpenCodes');
        Route::get('/{game}/last-open-codes-list', 'GamesController@getLastCodeList')->name('lastOpenCodeList');
        Route::get('/{game}/last10', 'GamesController@getLast10')->name('last10');
        Route::get('/{game}/open-time', 'GamesController@getOpenTime')->name('openTime'); //开奖时间
        Route::get('/pc28', 'GamesController@pc28')->name('pc28'); //北京幸运28欢迎界面
        Route::get('/pc28/play', 'GamesController@pc28Play')->name('pc28Play'); // 北京幸运28游戏界面
        Route::get('/pc28v25', 'GamesController@pc28v25')->name('pc28v25'); //北京幸运28 2.5倍欢迎界面
        Route::get('/pc28v25/play', 'GamesController@pc28v25Play')->name('pc28v25Play'); // 北京幸运28 2.5倍游戏界面
        Route::post('/{game}/bets', 'GamesController@bets')->name('dobets'); //下注
        Route::delete('/bets/{bet}', 'GamesController@cancelBet')->name('cancelBet'); //取消下注
        Route::get('/{game}/tab-list', 'GamesController@tabList')->name('tabList'); // 获取开奖历史
        Route::get('/{game}/bets', 'GamesController@userBets')->name('userBets'); //获取投注
        Route::get('/{game}/today-bets', 'GamesController@todayBets')->name('todayBets'); //获取投注
        Route::get('/{game}/fanshui', 'GamesController@fanshui')->name('fanshui'); //获取反水记录
        Route::get('/{game}/zoushi', 'GamesController@zoushi')->name('zoushi'); //获取开奖走势
    });

});

