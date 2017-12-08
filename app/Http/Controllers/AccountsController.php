<?php

namespace App\Http\Controllers;

use App\Capital;
use App\Login;
use Illuminate\Http\Request;

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




}
