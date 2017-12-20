<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\Guess;
use App\OpenCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GamesController extends Controller
{

    /**
     * pc28
     * 游戏展示页面
     * name = 北京幸运28
     *
     * @param Request $request
     *
     */
    public function pc28(Request $request)
    {
        $game = Game::where('name', '北京幸运28')->firstOrFail();

        return view('game.index', ['game_id' => $game->id]);
    }


    //下注界面
    public function pc28Play()
    {
        $game = Game::where('name', '北京幸运28')->firstOrFail();

        return view('game.play', ['game_id' => $game->id]);
    }


    //北京幸运28-2.5倍场
    public function pc28v25(Request $request)
    {
        $game = Game::where('name', '北京幸运28-2.5倍场')->firstOrFail();

        return view('game.pc28v25', ['game_id' => $game->id]);
    }


    //北京幸运28-2.5倍场 下注界面
    public function pc28v25Play()
    {
        $game = Game::where('name', '北京幸运28-2.5倍场')->firstOrFail();

        return view('game.pc28v25Play', ['game_id' => $game->id]);
    }


    //submit bets
    public function bets(Game $game, Request $request)
    {
        $actionNo = (OpenCode::where('game_id', $game->id)
                ->orderBy('open_time', 'desc')->limit(1)->first()->actionNo)
            + 1;
        $user_id = Auth::user()->id;
        $capital = Auth::user()->capital; //账户余额

        $sum = 0.00;  //下注总金额
        $bet_arr = []; //下注总数组

        //首先计算号码定位 玩法
        $tp100 = [];
        $tp100 = explode(',', $request['tp100']);

        if (count($tp100) > 0 && !empty($tp100['0'])) {
            foreach ($tp100 as $item_100) {
                $temp_arr = [];
                $temp_arr = explode('*', $item_100);
                if (count($temp_arr) > 0 && !empty($temp_arr['0'])) {
                    $sum += (int)$temp_arr['1'];
                    array_push($bet_arr, [
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time()),
                        'user_id'    => $user_id,
                        'game_id'    => $game->id,
                        'money'      => $temp_arr['1'],
                        'code'       => $temp_arr['0'],
                        'actionNo'   => $actionNo,
                    ]);
                }

            }
        }


        $type_arr = [
            'tp101' => '小',
            'tp102' => '大',
            'tp103' => '单',
            'tp104' => '双',
            'tp105' => '小单',
            'tp106' => '大单',
            'tp107' => '小双',
            'tp108' => '大双',
            'tp109' => '极小',
            'tp110' => '极大',
            'tp140' => '豹子',
            'tp141' => '顺子',
            'tp142' => '对子',
        ];


        foreach ($type_arr as $field => $type) {
            if ($request[$field] != '') {

                $sum += (int)$request[$field];

                array_push($bet_arr, [
                    'created_at' => date('Y-m-d H:i:s', time()),
                    'updated_at' => date('Y-m-d H:i:s', time()),
                    'code'       => $type,
                    'money'      => (float)$request[$field],
                    'user_id'    => $user_id,
                    'game_id'    => $game->id,
                    'actionNo'   => $actionNo,
                ]);
            }
        }

        if ($sum > $capital->money) {
            return [
                'status'  => 0,
                'msg'     => '账户余额不足',
                'referer' => '',
                'state'   => 'fail',
            ];
        }


        try {
            DB::transaction(function () use ($bet_arr, $capital, $sum) {
                DB::table('bets')->insert($bet_arr);
                $capital->money = $capital->money - $sum;
                $capital->save();
            });
        } catch (\Throwable $e) {
            return [
                'status'  => 0,
                'msg'     => '下注失败,请联系管理员:',
                'referer' => '',
                'state'   => 'fail',
            ];
        }


        return [
            'status'  => 1,
            'msg'     => '下注成功，请等待开奖',
            'referer' => '',
            'state'   => 'fail',
        ];

    }


    public function cancelBet(Bet $bet)
    {
        $result = [];
        $result['status'] = 0;
        $result['info'] = '取消失败';

        if ($bet->lotteried == 1) {
            return $result;
        }

        try {
            DB::transaction(function () use ($bet, &$result) {
                $money = $bet->money;
                $bet->delete();
                $capital = Auth::user()->capital;
                $capital->money += $money;
                $capital->save();

                $result['status'] = 1;
                $result['info'] = '取消下注成功';
            });
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }


        return $result;

    }


    //开奖结果
    public function getLastCodes(Game $game, int $code_id)
    {
        $gameModel = $game->load([
            'openCodes' => function ($query) use ($code_id) {
                return $query->where('actionNo', $code_id);
            },
        ]);

        //获取游戏对象
        $game = app()->make(Game\Game::class);


        $codes = $gameModel->openCodes->first();

        if ($codes == null) {
            return ['sign' => 'false'];
        }

        $code_arr = explode(',', $codes->codes);

        $result = [];

        $lottery = $game->lottery($gameModel->name, $codes->codes);


        $result['sign'] = "true";
        $result['referer'] = '';
        $result['full_expect'] = $codes->actionNo;
        $result['expect'] = $codes->actionNo;
        $result['open_time'] = $codes->open_time;
        $result['open_time_stamp'] = strtotime($codes->open_time);
        $result['add_time'] = strtotime($codes->created_at);
        $result['str_num'] = $codes->codes;
        $result['num1'] = $lottery['0'];
        $result['num2'] = $lottery['1'];
        $result['num3'] = $lottery['2'];
        $result['num4'] = $lottery['num'];
        $result['sum'] = $lottery['num'];
        $result['ptype1'] = $lottery['daxiao'];
        $result['ptype2'] = $lottery['danshuang'];
        $result['ptype3'] = $lottery['zuhe'];


        if (isset($lottery['baozi'])) {
            if ($lottery['baozi']) {
                $result['ptype5'] = $lottery['baozi'];
            } else {
                if ($lottery['shunzi']) {
                    $result['ptype5'] = $lottery['shunzi'];
                } else {
                    $result['ptype5'] = $lottery['duizi'];
                }
            }
        }


        $result['state'] = 'fail';

        return $result;
    }


    //获取开奖时间
    public function getOpenTime(Game $game)
    {

        $game = $game->load([
            'OpenCodes' => function ($query) {
                return $query->orderBy('created_at', 'desc')->limit('1');
            },
        ]);

        $lastOpen = $game->OpenCodes->first(); //上期开奖

        if ($lastOpen == null) {
            return ['sign' => 'false'];
        }

        $remainTime = strtotime("$lastOpen->open_time +5min") - time();

        $res_arr = [
            'currFullExpect' => $lastOpen->actionNo + 1,
            'lastFullExpect' => $lastOpen->actionNo,
            'referer'        => "",
            'remainTime'     => $remainTime,
            'sign'           => "true",
            'state'          => "fail",
        ];

        return $res_arr;
    }


    public function getLastCodeList(Game $game)
    {
        $game = $game->load([
            'openCodes' => function ($query) {
                return $query->orderBy('open_time', 'desc')->limit(10);
            },
        ]);
        $last10 = $game->openCodes;
        $arr['userbetList'] = [];
        $arr['sign'] = 'true';
        $arr['referer'] = '';
        $arr['state'] = 'fail';

        $last10->map(function ($item) use (&$arr) {
            $code_list_arr = explode(',', $item->codes);
            array_push($arr['userbetList'],
                ['num' => array_sum($code_list_arr)]);
        });


        return $arr;
    }

    public function getLast10(Game $game)
    {
        $gameModel = $game->load([
            'openCodes' => function ($query) {
                return $query->orderBy('open_time', 'desc')->limit(10);
            },
        ]);

        $game = app()->make(Game\Game::class);


        $result = [];
        $codes = $gameModel->openCodes;

        if ($codes->isEmpty()) {
            return $result;
        }


        foreach ($codes as $code) {
            $temp_arr = [];
            $lottery = $game->lottery($gameModel->name, $code->codes);
            $temp_arr['expect'] = $code->actionNo;
            $temp_arr['num1'] = $lottery['0'];
            $temp_arr['num2'] = $lottery['1'];
            $temp_arr['num3'] = $lottery['2'];
            $temp_arr['num4'] = $lottery['num'];
            $temp_arr['ptype1'] = $lottery['daxiao'];
            $temp_arr['ptype2'] = $lottery['danshuang'];
            $temp_arr['ptype3'] = $lottery['zuhe'];
            $temp_arr['ptype5'] = $lottery['jizhi'];
            if (isset($lottery['baozi'])) {
                if ($lottery['baozi']) {
                    $temp_arr['ptype5'] = $lottery['baozi'];
                } else {
                    if ($lottery['shunzi']) {
                        $temp_arr['ptype5'] = $lottery['shunzi'];
                    } else {
                        $temp_arr['ptype5'] = $lottery['duizi'];
                    }
                }
            }

            array_push($result, $temp_arr);
        }

        return $result;

    }


    //反水  逻辑还不清楚 暂时弄个假象
    public function fanshui(Game $game, Request $request)
    {
        $str
            = '{"list":"<div class=\"yxzxwqkq\"> <ul> <li class=\"first\"> <div class=\"w172\">\u65e5\u671f<\/div> <div class=\"w201\">\u7ec4\u5408\u6bd4\u4f8b<\/div> <div class=\"w186\">\u76c8\u4e8f<\/div> <div class=\"w149\">\u72b6\u6001<\/div> <div class=\"w244\">\u8fd4\u6c34<\/div> <\/li> <li style=\"line-height:20px; color:#888; padding:10px 0;\">\u5907\u6ce8\uff1a1\u3001\u8f93600\u4ee5\u4e0a\/\u4e0b\u6ce815\u628a\u4ee5\u4e0a; 2\u3001\u56de\u6c3410%\u8f931\u4e07\u4ee5\u4e0a12%; 3\u3001\u5f53\u5929\u8f93\u94b1\u6b21\u65e5\u51cc\u66682\u70b9\u524d\u7533\u8bf7\u56de\u6c34\u6709\u6548; 4\u3001\u8d85\u65f6\u65e0\u6cd5\u7533\u8bf7\uff0c\u4e0d\u53ef\u8865; 5\u3001\u5f53\u65e5\u7533\u8bf7\u56de\u6c34\u540e\u4e0d\u53ef\u4e0b\u6ce8\uff0c\u4e0b\u6ce8\u540e\u56de\u6c34\u4f1a\u88ab\u53d6\u6d88\uff01 <\/li> <\/ul> <\/div> <div class=\"pagination\"><\/div>","page":"1","count":0,"pageSize":10,"referer":"","state":"fail"}';

        return json_decode($str, true);
    }


    //走势
    public function zoushi(Game $game, Request $request)
    {

        $pageSize = 15;

        $open_codes = OpenCode::where('game_id', $game->id)
            ->orderBy('created_at', 'desc');

        $all_count = $open_codes->count();
        $open_codes = $open_codes->paginate($pageSize);

        $fields = [];

        for ($i = 0; $i <= 27; $i++) {
            $fields[] = $i;
        }

        $fields[] = '大';
        $fields[] = '小';
        $fields[] = '单';
        $fields[] = '双';
        $fields[] = '大单';
        $fields[] = '小单';
        $fields[] = '大双';
        $fields[] = '小双';
        $fields[] = '极大';
        $fields[] = '极小';


        if ($game->name == '北京幸运28-2.5倍场') {
            $fields[] = '顺子';
            $fields[] = '对子';
            $fields[] = '豹子';
        }

        $colors = [];
        $colors['28'] = 'bj_ffc300';
        $colors['29'] = 'bj_ff00e9';
        $colors['30'] = 'bj_ff9300';
        $colors['31'] = 'bj_b200ff';
        $colors['32'] = 'bj_ff0079';
        $colors['33'] = 'bj_00c22c';
        $colors['34'] = 'bj_c27400';
        $colors['35'] = 'bj_bfc200';
        $colors['36'] = 'bj_6400ff';
        $colors['37'] = 'bj_0090ff';
        $colors['38'] = 'bj_ffc300';
        $colors['39'] = 'bj_ff0079';
        $colors['40'] = 'bj_00c22c';


        $game_obj = app()->make(Game\Game::class)->getGame($game->name);
        $str
            = '<div class="yxzxkqzs"><table width="100%" border="0" cellspacing="1" cellpadding="0"><tbody><tr><th>期号</th>';

        foreach ($fields as $field) {
            $str .= '<th>'.$field.'</th>';
        }

        $str .= '</tr>';


        foreach ($open_codes as $codes) {
            $lottery = $game_obj->lottery($codes->codes);
            $str .= '<tr><td>'.$codes->actionNo.'</td>';
            foreach ($fields as $key => $field) {


                if ($key <= 27) {
                    if ($field == $lottery['num']) {
                        $str .= '<td class="bj_4688d1">'.$field.'</td>';
                    } else {
                        $str .= '<td></td>';
                    }
                } else {

                    switch ($field) {

                        case '大':
                        case '小':

                            if ($field == $lottery['daxiao']) {
                                $str .= '<td class="'.$colors[$key].'">'.$field
                                    .'</td>';
                            } else {
                                $str .= '<td></td>';
                            }
                            break;
                        case '单':
                        case '双':
                            if ($field == $lottery['danshuang']) {
                                $str .= '<td class="'.$colors[$key].'">'.$field
                                    .'</td>';
                            } else {
                                $str .= '<td></td>';
                            }
                            break;
                        case '大单':
                        case '小单':
                        case '大双':
                        case '小双':
                            if ($field == $lottery['zuhe']) {
                                $str .= '<td class="'.$colors[$key].'">·</td>';
                            } else {
                                $str .= '<td></td>';
                            }
                            break;
                        case '极大':
                        case '极小':
                            if ($field == $lottery['jizhi']) {
                                $str .= '<td class="'.$colors[$key].'">·</td>';
                            } else {
                                $str .= '<td></td>';
                            }
                            break;

                    }

                    if (isset($lottery['baozi'])) {
                        switch ($field) {
                            case '顺子':
                            case '豹子':
                            case '对子':
                                if ($field == $lottery['baozi']
                                    || $field == $lottery['duizi']
                                    || $field == $lottery['shunzi']
                                ) {
                                    $str .= '<td class="'.$colors[$key]
                                        .'">·</td>';
                                } else {
                                    $str .= '<td></td>';
                                }

                                break;
                        }
                    }


                }
            }

            $str .= '</tr>';
        }

        $str .= '</tbody></table></div><div class="pagination"></div>';

        $result = [];
        $result['page'] = $request->has('page') ? $request['page'] : '1';
        $result['pageSize'] = $pageSize;
        $result['referer'] = '';
        $result['state'] = 'fail';
        $result['count'] = $all_count;
        $result['list'] = $str;

        return $result;

    }


    //猜数
    public function guess(Game $game, Request $request)
    {

        $this->validate($request, [
            'tp999' => 'required|min:0|max:27|numeric',
        ]);


        $openCode = new OpenCode();
        $current_expect = $openCode->currentExpect($game->id);

        $level_1 = 1001;
        $level_2 = 2000;
        $level_3 = 5000;
        $level_4 = 10000;

        $level_1_profit = 88; //奖励金额
        $level_2_profit = 188; //奖励金额
        $level_3_profit = 588; //奖励金额
        $level_4_profit = 888; //奖励金额


        $sum = 0;
        $profit = 0; //奖励金额
        $result = [];
        $result['status'] = 0;
        $result['info'] = '当期投注未满足要求';


        //是否已经 猜数

        $guess = Guess::where('user_id', Auth::user()->id)
            ->where('actionNo', $current_expect)->first();


        if ($guess != null) {
            $result['info'] = '当期已经猜数';

            return $result;
        }


        $bets = Bet::where('game_id', $game->id)
            ->where('actionNo', $current_expect)
            ->where('user_id', Auth::user()->id)
            ->first([DB::raw('sum(money) as money')]);

        $sum = ($bets->money != null) ? $bets->money : 0;

        if ((int)$sum < 1001) {
            return $result;
        }


        if ($sum > $level_1 && $sum <= $level_2) {
            $profit = $level_1_profit;
        }

        if ($sum > $level_2 && $sum <= $level_3) {
            $profit = $level_2_profit;
        }

        if ($sum > $level_3 && $sum <= $level_4) {
            $profit = $level_3_profit;
        }

        if ($sum > $level_4) {
            $profit = $level_4_profit;
        }

        if ($game->guesses()->create([
            'user_id'  => Auth::user()->id,
            'actionNo' => $current_expect,
            'number'   => $request['tp999'],
            'money'    => $profit,
        ])
        ) {
            $result['status'] = 1;
            $result['info'] = '猜数成功';
        }

        return $result;

    }


    public function todayBets(Game $game, Request $request)
    {
        $userBetList = [];
        $result = [];

        $pageSize = '10';

        $bets = Bet::where('user_id', Auth::user()->id)
            ->where('game_id', $game->id)->orderBy('created_at', 'desc');
        $all_count = $bets->count();
        $bets = $bets->paginate($pageSize);

        $result['sign'] = 'true';
        $result['referer'] = '';
        $result['state'] = 'fail';


        $actionNo_arr = [];

        foreach ($bets as $bet) {


            $temp_arr = [];
            $state = '0';
            $temp_arr['billno'] = $bet->id;
            $temp_arr['expect'] = $bet->actionNo;
            $temp_arr['betsTimes'] = $bet->created_at->__toString();
            $temp_arr['code'] = $bet->code;
            $temp_arr['betsMoney'] = $bet->money;
            $temp_arr['prizeMoney'] = $bet->profit;
            $temp_arr['betid'] = $bet->id;

            if ($bet->lotteried == 1) {
                $state = '1';
            }

            if ($bet->profit > 0) {
                $state = '2';
            }
            $temp_arr['state'] = $state;

            array_push($actionNo_arr, $bet->actionNo);
            array_push($userBetList, $temp_arr);
        }

        //猜数

        $guesses = Guess::where('user_id', Auth::user()->id)
            ->where('game_id', $game->id)
            ->whereIn('actionNo',array_unique($actionNo_arr))
            ->orderBy('created_at', 'desc')
            ->get();


        foreach($guesses as $guess) {
            $temp_arr = [];
            $state = "0";
            $temp_arr['billno'] = 'g_'.$guess->id;
            $temp_arr['expect'] = $guess->actionNo;
            $temp_arr['betsTimes'] = $guess->created_at->__toString();
            $temp_arr['code'] = $guess->number.'(猜数)';
            $temp_arr['betsMoney'] = $guess->money;
            $temp_arr['prizeMoney'] = $guess->profit;

            $temp_arr['betid'] = 'g'.$guess->id;

            if ($guess->lotteried == 1) {
                //未中奖
                $state = '1';
            }

            if ($guess->profit > 0) {
                $state = "2";
            }


            $temp_arr['state'] = $state;


            array_push($userBetList, $temp_arr);
            $all_count += 1;
        }

        $page = $request->has('page') ? $request->input('page') : '1';


        $result['userbetList'] = $userBetList;
        $result['page'] = $page;
        $result['count'] = $all_count;
        $result['pageSize'] = $pageSize;

        return $result;


    }


    public function tabList(Game $game, Request $request)
    {
        $bet_arr = [];
        $user_count = [];
        $expect_money_sum = [];
        $pageSize = 10;
        $all_count = OpenCode::where('game_id', $game->id)->count();
        $codes = OpenCode::where('game_id', $game->id)
            ->orderBy('open_time', 'desc')->paginate($pageSize);
        foreach ($codes as $code) {
            $temp_arr = [];
            $temp_arr['expect'] = $code->actionNo;
            $temp_arr['codes'] = $code->codes;
            $temp_arr['open_time'] = $code->open_time;
            if (!isset($user_count[$code->actionNo])) {
                $user_count[$code->actionNo] = 0;
            }

            if (!isset($expect_money_sum[$code->actionNo])) {
                $expect_money_sum[$code->actionNo] = 0;
            }
            $user_count[$code->actionNo] += 1;
            $bets = Bet::where('actionNo', $code->actionNo)->get();
            foreach ($bets as $bet) {
                $expect_money_sum[$code->actionNo] += $bet->money;
            }

            array_push($bet_arr, $temp_arr);
        }


        $str
            = '<div class="yxzxwqkq"> <ul> <li class="first"> <div class="w172">期号</div> <div class="w201">开奖时间</div> <div class="w186">参与人数</div> <div class="w149">投注金额</div> <div class="w244">开奖号码</div></li>';

        foreach ($bet_arr as $bet) {
            $str .= '<li><div class="w172">'.$bet['expect'].'</div>';
            $str .= '<div class="w201">'.$bet['open_time'].'</div>';
            $str .= '<div class="w186">'.mt_rand(100, 500).'</div>';
            $str .= ' <div class="w149">'.mt_rand(100,1000)
                .'00</div>';
            $open_code_lst = explode(',', $bet['codes']);
            $str .= '<div class="w244"><i class="bgbl">'.$open_code_lst['0']
                .'</i>+<i class="bgbl">'.$open_code_lst['1']
                .'</i>+<i class="bgbl">'.$open_code_lst['2']
                .'</i>=<i class="bgred">'.array_sum($open_code_lst)
                .'</i></div></li>';
        }
        $str .= '</ul></div><div class="pagination"></div>';


        $page = $request->has('page') ? $request->input('page') : '1';

        $result = [];

        $result['list'] = $str;

        $result['page'] = (string)$page;

        $result['count'] = $all_count;

        $result['pageSize'] = $pageSize;

        $result['referer'] = '';

        $result['state'] = 'fail';

        return $result;
    }


    //获取投注列表
    public function userBets(Game $game, Request $request)
    {
        $pageSize = 10;
        $bets = Bet::where('game_id', $game->id)
            ->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc');

        //是否今日开奖
        if ($request->has('today')) {
            $bets = $bets->whereDate('created_at', date('Y-m-d', time()));
        }

        $all_count = $bets->count();

        $bets = $bets->paginate($pageSize);

        $str
            = ' <div class="tzfa yxzxtzfa"> <!--投注方案--> <ul> <li class="first"> <div class="ddh">订单号</div> <div class="xdsj">下单时间</div> <div class="wf">号码</div> <div class="qh">期号</div> <div class="tzje">投注金额</div> <div class="jj">奖金</div> <div class="zt">状态</div> </li> ';

        foreach ($bets as $bet) {
            $status = $bet->lotteried == '1' ? '已开奖' : '未开奖';
            $str .= '<li><div class="ddh">'.$bet->id.'</div>';
            $str .= '<div class="xdsj">'.$bet->created_at.'</div>';
            $str .= '<div class="wf">'.$bet->code.'</div>';
            $str .= '<div class="qh">'.$bet->actionNo.'</div>';
            $str .= '<div class="tzje">'.$bet->money.'</div>';
            $str .= '<div class="jj">'.$bet->profit.'</div>';
            $str .= '<div class="zt">'.$status.'</div> </li>';

        }
        $str .= '</ul></div><div class="pagination"></div>';

        $page = $request->has('page') ? $request->input('page') : '1';

        $result = [];

        $result['list'] = $str;

        $result['page'] = (string)$page;

        $result['count'] = $all_count;

        $result['pageSize'] = $pageSize;

        $result['referer'] = '';

        $result['state'] = 'fail';

        return $result;

    }


}
