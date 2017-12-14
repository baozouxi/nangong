<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Capital;
use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 账户控制器
 * 包括用户资料 资金
 * Class AccountsController
 *
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
        $capital = Capital::where('user_id', $user_id)->first();

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

        $user_id = \Auth::user()->id;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::where('user_id', $user_id)->first();

        return view('account.withdraw', compact('lastLogin', 'capital'));

    }


    //财务记录
    public function capitalLog()
    {
        $user_id = \Auth::user()->id;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::where('user_id', $user_id)->first();

        return view('account.capital-log', compact('lastLogin', 'capital'));
    }

    //代理中心
    public function agency()
    {
        $user_id = \Auth::user()->id;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::where('user_id', $user_id)->first();

        return view('account.agency', compact('lastLogin', 'capital'));
    }


    //安全中心
    public function safe()
    {
        $user_id = \Auth::user()->id;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::where('user_id', $user_id)->first();

        return view('account.safe', compact('lastLogin', 'capital'));
    }


    public function userInfo()
    {
        return '<span>欢迎您，'.Auth::user()->username.'</span><span>账户余额：<i>￥'
            .number_format(Auth::user()->capital->money, 2)
            .'</i></span><a href="'.route('account.recharge')
            .'">充值</a><a href="'.route('account.withdraw')
            .'">提现</a><a href="/user/message/index?v1">消息中心 <i>5</i></a><a href="#"  class="logout">退出</a>';
    }


    //盈亏
    public function money(Request $request)
    {
        $expand = 0;
        $get = 0;

        $money = Auth::user()->capital->money;

        $bets = Bet::where('user_id', Auth::user()->id)
            ->where('actionNo', $request->input('expect'))->get();

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


//    修改密码
    public function changePass(Request $request)
    {
        $result = [];
        $result['status'] = 0;
        $result['msg'] = '修改失败，请联系管理员';

        $this->validate($request, [
            'old_password' => 'required|min:6',
            'password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if ($user->getAuthPassword() != bcrypt($request['old_password'])) {
            $result['msg'] = '原密码错误';

        }
        $user->password = bcrypt($request['password']);
        if (!$user->save()) {
            Log::error('修改密码失败',DB::getQueryLog());
            $result['msg'] = '修改失败，请联系管理员';
            return $result;
        }

        $result['status'] = 1;
        $result['msg'] = '修改成功';

        return $result;



    }

}
