<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Capital;
use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 账户控制器
 * 包括用户资料 资金
 * Class AccountsController
 * @package App\Http\Controllers
 */
class AccountsController extends Controller
{

    //个人中心
    public function user()
    {
        $user_id = \Auth::user()->id;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::find($user_id);
        return view('account.user', compact('lastLogin', 'capital'));
    }

    //充值中心
    public function recharge()
    {
        return view('account.recharge');
    }

    //提现
    public function withdraw()
    {
        return view('account.withdraw');
    }


    //财务记录
    public function capitalLog()
    {
        return view('account.capital-log');
    }

    //代理中心
    public function agency()
    {
        return view('account.agency');
    }


    //安全中心
    public function safe()
    {
        return view('account.safe');
    }


    public function userInfo()
    {
        return '<span>欢迎您，baozouxi</span><span>账户余额：<i>￥'. number_format(Auth::user()->capital->money, 2).'</i></span><a href="/user/profile/pay.html">充值</a><a href="/user/profile/themoney.html">提现</a><a href="/user/message/index?v1">消息中心 <i>5</i></a><a href="#"  class="logout">退出</a>';
    }


    //盈亏
    public function money(Request $request)
    {
        $expand = 0;
        $get = 0;

        $money = Auth::user()->capital->money;

        $bets = Bet::where('user_id',Auth::user()->id)->where('actionNo',$request->input('expect'))->get();

        foreach ($bets as $bet) {
            $expand += $bet->money;
            $get += $bet->profit;
        }

        $result = [];
        $result['expect'] = 0;
        $result['referer'] = '';
        $result['sign'] = 'true';
        $result['state'] = 'fail';
        $result['userMoney'] = number_format(($money + $get - $expand), 2);
        return $result;
    }





}