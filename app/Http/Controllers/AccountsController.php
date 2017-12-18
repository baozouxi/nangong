<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankName;
use App\Bet;
use App\Capital;
use App\CapitalLog;
use App\Login;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $user = Auth::user();
        $user_id = $user->id;
        $phone = $user->phone;
        $login = new Login();
        $lastLogin = $login->lastLogin($user_id);
        $capital = Capital::where('user_id', $user_id)->first();

        $bankName = $user->bankName ? $user->bankName->name : '';

        $cards = $user->cards->load('bank');

        return view('account.user',
            compact('lastLogin', 'capital', 'phone', 'bankName', 'cards'));
    }

    public function logs(Request $request)
    {

        $logs = new CapitalLog();

        $logs = $logs->where('user_id', Auth::user()->id);

        if ($request->has('type')) {
            $logs = $logs->where('type', $request['type']);
        }

        if ($request->has('date')) {
            $logs = $logs->whereDate('created_at', $request['date']);
        }

        $all_count = $logs->count();
        $logs = $logs->get();



        $str
            = '<div class="yx_list"><li class="first"> <div class="yxmc">时间</div> <div class="yl">金额变动</div> <div class="time">变动详情</div> <div class="gl">状态</div> </li>';


        foreach ($logs as $log) {
            $type = $log->type == CapitalLog::RECHARGE ? '充值' : '提现';
            $status = $log->ok ? '已到账' : '未处理';
            $str .= '<li><div class="yxmc">'.$log->created_at.'</div>';
            $str .= '<div class="yl">'.$log->money.'</div>';
            $str .= '<div class="time">'.$type.'</div>';
            $str .= '<div class="gl">'.$status.'</div>';
            $str .= '</li>';
        }

        $str .= '</div><div class="pagination"></div>';

        $result = [];
        $result['list'] = $str;
        $result['page'] = '1';
        $result['count'] = $all_count;
        $result['pageSize'] = '10';
        $result['referer'] = '';
        $result['state'] = 'fail';


        return $result;
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

        $cards = Auth::user()->cards;


        return view('account.withdraw',
            compact('lastLogin', 'capital', 'cards'));

    }


    //submit withdraw
    public function doWithdraw(Request $request)
    {
        $this->validate($request, [
            't0' => 'required|min:50|numeric',
            't1' => 'required|min:0|exists:cards,id',
            't2' => 'required|string',
        ]);

        $user = Auth::user();
        $result = [];
        $result['status'] = 0;
        $result['msg'] = '请求失败';
        if (!Hash::check($request['t2'], $user->money_password)) {
            $result['msg'] = '资金密码错误';

            return $result;
        }

        if ($request['t0'] > $user->capital->money) {
            $result['msg'] = '账户余额不足';

            return $result;
        }


        if ($user->withdraws()->create([
            'money'   => $request['t0'],
            'card_id' => $request['t1'],
        ])
        ) {
            $result['status'] = 1;
            $result['msg'] = '请求成功，请等待管理员处理';
        }

        return $result;

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
        $bank_list = Bank::all();
        $bank_name = Auth::user()->bankName ? Auth::user()->bankName->name : '';

        return view('account.safe',
            compact('lastLogin', 'capital', 'bank_list', 'bank_name'));
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

        if (!Hash::check($request['old_password'], $user->getAuthPassword())) {
            $result['msg'] = '原密码错误';

            return $result;


        }
        $user->password = bcrypt($request['password']);
        if (!$user->save()) {
            Log::error('修改密码失败', DB::getQueryLog());
            $result['msg'] = '修改失败，请联系管理员';

            return $result;
        }

        $result['status'] = 1;
        $result['msg'] = '修改成功';

        return $result;

    }


    //    修改资金密码
    public function changeMoneyPass(Request $request)
    {
        $result = [];
        $result['status'] = 0;
        $result['msg'] = '修改失败，请联系管理员';

        $this->validate($request, [
            'old_password' => 'required|min:6',
            'password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request['old_password'], $user->money_password)) {
            $result['msg'] = '原密码错误';

            return $result;
        }
        $user->money_password = bcrypt($request['password']);
        if (!$user->save()) {
            Log::error('修改资金密码失败', DB::getQueryLog());
            $result['msg'] = '修改失败，请联系管理员';

            return $result;
        }

        $result['status'] = 1;
        $result['msg'] = '修改成功';

        return $result;

    }


    //添加银行用户名
    public function addBankName(Request $request)
    {

        $result = [];
        $result['status'] = 0;
        $result['msg'] = '添加失败';

        $this->validate($request, [
            'bank_account_name' => 'required|min:2',
        ]);


        $bankName = BankName::where('user_id', Auth::user()->id)->get();
        if ($bankName->isNotEmpty()) {
            $result['msg'] = '已经绑定用户';

            return $result;
        }

        if (!BankName::create([
            'name'    => $request['bank_account_name'],
            'user_id' => Auth::user()->id,
        ])
        ) {
            $result['msg'] = '添加失败';
        }

        $result['status'] = 1;
        $result['msg'] = '添加成功';

        return $result;
    }


    //添加银行卡号
    public function addCards(Request $request)
    {
        $this->validate($request, [
            'banktype'     => 'required',
            'alipay'       => 'nullable|string|confirmed',
            'passmoney1'   => 'nullable|string',
            'bankname'     => 'nullable',
            'userbankcard' => 'nullable|string|confirmed',
            'passmoney2'   => 'nullable',
        ]);

        $user = Auth::user();
        $result = [];
        $result['status'] = 0;
        $result['msg'] = '添加失败';


        //处理银行

        if ($request['passmoney2']) {

            if (!Hash::check($request['passmoney2'], $user->money_password)) {
                $result['msg'] = '资金密码错误';

                return $result;
            }


            if ($user->cards()->create([
                'bank_id' => $request['bankname'],
                'user_id' => $user->id,
                'number'  => $request['userbankcard'],
            ])
            ) {
                $result['status'] = 1;
                $result['msg'] = '添加成功';
            }

        }

        return $result;


    }


    //获取用户银行账户列表
    public function getCards()
    {
        $str = '';

        $user = Auth::user();


        if ($bankName = $user->bankName) {

            if ($cars = $user->cards) {
                $cars->load('bank');
                foreach ($cars as $car) {
                    $str .= '<li><span class="zhlx"><i class="bankicoall" style="background: url(/themes/simplebootx/Public/images/0000'
                        .$car->bank_id.'.png) no-repeat 0 0;"></i>'
                        .$car->bank->name.'</span><span class="zhid">'
                        .$car->number.'</span><span class="zhname">'
                        .$bankName->name
                        .'</span><a href="javascript:;" onclick="del_bank_info('
                        .$car->bank_id.')" class="zhsc"></a></li>';
                }
            }
        }

        return $str;

    }


}
