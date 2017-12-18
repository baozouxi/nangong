<?php

namespace App\Http\Controllers;

use App\Admin;
use App\CapitalLog;
use App\User;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function index()
    {
        return view('admin.index');
    }


    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|exists:admins',
            'password' => 'required|min:6',
        ], [
            'username.reqired'  => '请输入用户名',
            'username.exists'   => '该用户不存在',
            'password.required' => '请输入密码',
            'password.min'      => '密码格式错误',
        ]);


        $admin = Admin::where('username', $request['username'])->first();

        if (!Hash::check($request['password'], $admin->password)) {
            return back()->with(['password' => '密码错误']);
        }

        session()->push('admin-id', $admin->id);
        session()->push('admin-username', $admin->username);

        return redirect(route('admin.index'));


    }


    public function logout()
    {
        session()->flush();

        return redirect(route('admin.login'));
    }


    //用户列表
    public function users()
    {
        $users = User::with([
            'capital',
            'cards',
            'bankName',
            'login' => function ($query) {
                return $query->orderBy('login_time', 'desc');
            },
        ])->get();


        return view('admin.users', compact('users'));

    }


    //充值
    public function recharge(Request $request, User $user)
    {

        $this->validate($request, [
            'money' => 'required|numeric|min:0',
        ]);

        $money = $request['money'];
        $result = [];
        $result['status'] = '0';

        try {
            DB::transaction(function () use ($user, $money, &$result) {
                $capital = $user->capital;
                $capital->money += $money;
                $capital->save();
                $user->capitalLogs()->create([
                    'money'      => $money,
                    'capital_id' => $capital->id,
                    'type'       => CapitalLog::RECHARGE,
                    'ok'         => 1,
                ]);
                $result['status'] = 1;

                $result['money'] = $capital->money;

            });

        } catch (\Throwable $e) {
            Log::error('充值失败：'.$e->getMessage());
        }

        return $result;

    }


    //充值记录
    public function capitalLogs()
    {

        $capitalLogs = CapitalLog::with('user')->orderBy('created_at', 'desc')
            ->get();


        return view('admin.capital-logs', compact('capitalLogs'));
    }


    //用户信息修改
    public function userUpdate(Request $request, User $user)
    {

        $this->validate($request, [
            'enable' => [
                'nullable',
                Rule::in([0, 1]),
            ],
            'phone'  => [
                'nullable',
                'min:11',
                'regex:/^1\d{1}\d{1}\d{8}/',
                'unique:users',
            ],
        ]);

        $result = [];
        $result['status'] = 0;


        if ($user->update($request->all())) {
            $result['status'] = 1;
        }


        return $result;

    }


    //取消充值
    public function cancelCapitalLog(CapitalLog $capitalLog)
    {
        $result = [];
        $result['status'] = 0;
        try {
            DB::transaction(function () use ($capitalLog, &$result) {
                $capital = $capitalLog->capital;
                $capital->money -= $capitalLog->money;
                $capital->save();
                $capitalLog->delete();
            });
            $result['status'] = 1;
        } catch (\Throwable $e) {
            Log::error('订单取消失败：', $e->getTrace());
        }

        return $result;
    }


    //提现请求
    public function withDraws(Request $request)
    {
        $withdraws = Withdraw::orderBy('created_at', 'desc')->with([
            'card',
            'card.bank',
            'user',
            'user.capital',
            'user.bankName',
        ])->get();


        return view('admin.withdraws', compact('withdraws'));
    }


    public function updateWithdraw(Withdraw $withdraw)
    {
        $result = [];
        $result['status'] = 0;
        $result['info'] = '操作失败';
        $user = $withdraw->user;

        try {
            DB::transaction(function () use ($withdraw, $user, &$result) {
                $withdraw->ok = 1;
                $withdraw->save();
                $capital = $user->capital;
                $capital->money -= $withdraw->money;
                $capital->save();

                $user->capitalLogs()->create([
                    'type'       => CapitalLog::WITHDRAW,
                    'money'      => $withdraw->money,
                    'user_id'    => $user->id,
                    'capital_id' => $capital->id,
                    'ok'         => 1,
                ]);

                $result['status'] = 1;
                $result['info'] = '操作成功';

            });
        } catch (\Throwable $exception) {
            Log::error('提现失败：'.$exception->getMessage());
        }


        return $result;


    }

}
