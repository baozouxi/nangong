<?php

namespace App\Http\Controllers;

use App\Account;
use App\Ad;
use App\Admin;
use App\Agent;
use App\AgentMoney;
use App\Article;
use App\Bet;
use App\Capital;
use App\CapitalLog;
use App\Game;
use App\Kefu;
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

    Const PAGE_SIZE = 10;

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
            'agent',
            'capital',
            'cards',
            'bankName',
            'login' => function ($query) {
                return $query->orderBy('login_time', 'desc');
            },
        ])->paginate(self::PAGE_SIZE);


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


                $capital->money = $capital->money + $money;
                $capital->save();

                CapitalLog::create([
                    'money'      => $money,
                    'capital_id' => $capital->id,
                    'user_id'    => $user->id,
                    'type'       => CapitalLog::RECHARGE,
                    'ok'         => 1,
                ]);

                //代理
                $leader = $user->leader;

                if (!$leader->isEmpty()) {
                    $agent = $leader->first();

                    //是否启用
                    if ($agent->enable) {
                        $profit = bcmul($money, $agent->point);
                        $profit = bcdiv($profit, 100);
                        $agent->money += $profit;
                        $agent->save();

                        AgentMoney::create([
                            'user_id'  => $user->id,
                            'agent_id' => $agent->id,
                            'point'    => $agent->point,
                            'money'    => $money,
                            'profit'   => $profit,
                        ]);

                        $leader_user = $agent->user;
                        //给用户充值
                        $user_capital = $leader_user->capital;
                        $user_capital->money += $profit;
                        $user_capital->save();

                    }
                }


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
            ->paginate(self::PAGE_SIZE);


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
        ])->paginate(self::PAGE_SIZE);


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


    // 投注记录
    public function bets(Game $game)
    {
        $bets = Bet::where('game_id', $game->id)->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_SIZE);

        $result = [];
        $users = [];


        foreach ($bets as $bet) {

            if (!isset($users[$bet->actionNo])) {
                $users[$bet->actionNo] = [];
            }

            if (!isset($result[$bet->actionNo])) {
                $result[$bet->actionNo] = [];
                $result[$bet->actionNo]['money'] = 0;
                $result[$bet->actionNo]['profit'] = 0;
                $result[$bet->actionNo]['user_count'] = 0;
            }
            $result[$bet->actionNo]['money'] += $bet->money;
            $result[$bet->actionNo]['profit'] += $bet->profit;
            array_push($users[$bet->actionNo], $bet->user_id);
        }


        foreach ($users as $actionNo => $count) {
            $result[$actionNo]['user_count'] = count(array_unique($count));
        }


        return view('admin.bets',
            ['bets' => $result, 'game_id' => $game->id, 'bet_obj' => $bets]);

    }


    public function userBetsList(User $user)
    {
        $bets = Bet::where('user_id', $user->id)->with(['game', 'user'])
            ->orderBy('created_at', 'desc')->paginate(self::PAGE_SIZE);

        return view('admin.user-bets-list', compact('bets'));
    }


    public function betsList(Game $game, int $actionNo)
    {


        $bets = Bet::where('game_id', $game->id)->where('actionNo', $actionNo)
            ->with('user')->paginate();
        $result = [];

        foreach ($bets as $bet) {
            if (!isset($result[$bet->user_id])) {
                $result[$bet->user_id] = [];
                $result[$bet->user_id]['money'] = 0;
                $result[$bet->user_id]['profit'] = 0;
                $result[$bet->user_id]['codes'] = '';
                $result[$bet->user_id]['username'] = '';
                $result[$bet->user_id]['actionNo'] = 0;
            }

            $result[$bet->user_id]['money'] += $bet->money;
            $result[$bet->user_id]['profit'] += $bet->profit;
            $result[$bet->user_id]['codes'] .= $bet->code.',';
            $result[$bet->user_id]['username'] = $bet->user->username;
            $result[$bet->user_id]['actionNo'] = $bet->actionNo;
        }


        return view('admin.bets-list', ['bets' => $result]);

    }


    public function articles()
    {
        $articles = Article::paginate(self::PAGE_SIZE);

        return view('admin.article-list', compact('articles'));
    }


    public function articleCreate()
    {
        return view('admin.article-create');
    }


    public function submitArticle(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'body'  => 'required|string',
        ]);


        if (Article::create([
            'title' => $request['title'],
            'body'  => $request['body'],
        ])
        ) {
            return redirect(route('admin.articles'));
        }

    }


    public function deleteArticle(Article $article)
    {
        if ($article->delete()) {
            return ['status' => 'ok'];
        }

        return ['status' => 'error'];

    }


    //get Ad
    public function ad()
    {
        $ad = Ad::first();

        return view('admin.ad', compact('ad'));

    }

    public function updateAd(Ad $ad, Request $request)
    {
        $this->validate($request, [
            'body' => 'required|string',
        ]);
        $ad->body = $request['body'];

        if ($ad->save()) {
            return redirect(route('admin.ad'));
        }


    }


    public function kefu()
    {
        $kefus = Kefu::all();

        return view('admin.kefu-list', compact('kefus'));
    }

    public function kefuCreate()
    {
        return view('admin.kefu-create');
    }


    public function kefuSubmit(Request $request)
    {
        $this->validate($request, [
            'way'  => 'required|string',
            'type' => 'required|in:1,2',
        ]);

        if (Kefu::create($request->all())) {
            return redirect(route('admin.kefu'));
        }

    }

    public function kefuEdit(Kefu $kefu)
    {
        return view('admin.kefu-edit', compact('kefu'));
    }


    public function kefuUpdate(Kefu $kefu, Request $request)
    {
        $this->validate($request, [
            'way'  => 'required|string',
            'type' => 'required|in:1,2',
        ]);

        if ($kefu->update($request->all())) {
            return redirect(route('admin.kefu'));
        }
    }


    public function kefuDelete(Kefu $kefu)
    {
        $result = [];
        $result['status'] = 'error';
        $result['info'] = '修改失败';
        if ($kefu->delete()) {
            $result['status'] = 'ok';
            $result['info'] = '修改成功';
        }

        return $result;

    }


    //收款账户
    public function accounts()
    {
        $accounts = Account::paginate(self::PAGE_SIZE);

        return view('admin.account-list', compact('accounts'));

    }

    public function accountCreate()
    {
        return view('admin.account-create');
    }


    public function accountSubmit(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|string|',
            'tips'   => 'nullable|string',
            'number' => 'required|string',
            'way'    => 'required|string',
        ]);

        if (Account::create($request->all())) {
            return redirect(route('admin.accounts'));
        }

    }


    public function accountUpdate(Account $account)
    {
        return view('admin.account-update', compact('account'));
    }


    public function accountUpdateSubmit(Account $account, Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|string|',
            'tips'   => 'nullable|string',
            'number' => 'required|string',
            'way'    => 'required|string',
        ]);

        if ($account->update($request->all())) {
            return redirect(route('admin.accounts'));
        }

    }


    public function accountDelete(Account $account)
    {
        $result = [];
        $result['status'] = 'error';
        $result['info'] = '删除失败';

        if ($account->delete()) {
            $result['status'] = 'ok';
            $result['info'] = '删除成功';
        }

        return $result;
    }


    public function updateMoney(User $user, Request $request)
    {
        $this->validate($request, [
            'money' => 'required|numeric|min:0',
        ]);

        $capital = $user->capital;
        $result = [];
        $result['status'] = 'error';
        $result['info'] = '修改失败';


        if ($capital->update($request->all())) {
            $result['status'] = 'ok';
            $result['info'] = '修改失败';
            $result['money'] = $capital->money;
        }

        return $result;

    }


    //改密码
    public function changaPass(Request $request)
    {
        $this->validate($request, [
            'oldpass'  => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);


        $admin = Admin::findOrFail(session()->get('admin-id'));


        $admin = $admin->first();

        $result = [];
        $result['status'] = 'error';
        $result['info'] = '修改失败';


        if (!Hash::check($request['oldpass'], $admin->password)) {
            $result['info'] = '原密码错误';

            return $result;
        }


        $request['password'] = bcrypt($request['password']);

        if (!$admin->update($request->all())) {
            $result['info'] = '修改失败，请联系管理员';
            Log::error('管理员密码修改失败：');

            return $result;

        }

        $result['status'] = 'ok';
        $result['info'] = '修改成功';

        return $result;

    }


    public function agents()
    {
        $agents = Agent::with(['user'])->withCount('followers')->get();


        return view('admin.agents', compact('agents'));
    }

    public function agentsStore(User $user, Request $request)
    {
        $this->validate($request, [
            'point' => 'required|numeric|min:0',
            'tips'  => 'nullable|string',
        ]);


        if (Agent::where('user_id', $user->id)->first() != null) {
            return ['status' => 'error', 'info' => '该用户已经为代理'];
        }


        if (Agent::create([
            'user_id' => $user->id,
            'point'   => $request['point'],
            'tips'    => $request['tips'],
        ])
        ) {
            return ['status' => 'ok'];
        }


        return ['status' => 'error', 'info' => '创建失败'];

    }



    public function agentsEdit(Agent $agent)
    {
        return view('admin.agentEdit', ['agent'=>$agent]);
    }


    public function agentsUpdate(Request $request, Agent $agent)
    {
        $this->validate($request, [
            'point' => 'required|numeric|min:0',
            'tips' => 'nullable|string'
        ]);

        if($agent->update($request->all())){
            return redirect(route('admin.agents'));
        }

        return '修改失败';



    }

}
