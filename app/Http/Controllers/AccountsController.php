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

    public function user()
    {
        $user_id = \Auth::user()->id;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::find($user_id);
        return view('account.user', compact('lastLogin', 'capital'));
    }

    public function recharge()
    {
        return view('account.recharge');
    }


    public function capitalLog()
    {
        return view('account.capital-log');
    }


    public function agency()
    {
        return view('account.agency');
    }

    public function safe()
    {
        return view('account.safe');
    }

}
