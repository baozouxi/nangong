<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\OpenCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GamesController extends Controller
{

    /**
     * pc28
     * 游戏展示页面
     * name = 北京幸运28
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


    //submit bets
    public function bets(Game $game, Request $request)
    {
        $actionNo = (OpenCode::where('game_id', $game->id)->orderBy('open_time', 'desc')->limit(1)->first()->actionNo) + 1;
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
                    array_push($bet_arr, ['created_at'=>date('Y-m-d H:i:s', time()),'updated_at'=>date('Y-m-d H:i:s', time()), 'user_id' => $user_id, 'game_id' => $game->id, 'money' => $temp_arr['1'], 'code' => $temp_arr['0'], 'actionNo' => $actionNo]);
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
        ];


        foreach ($type_arr as $field => $type) {
            if ($request[$field] != '') {

                $sum += (int)$request[$field];

                array_push($bet_arr, ['created_at'=>date('Y-m-d H:i:s', time()),'updated_at'=>date('Y-m-d H:i:s', time()),'code' => $type, 'money' => (float)$request[$field], 'user_id' => $user_id, 'game_id' => $game->id, 'actionNo' => $actionNo]);
            }
        }

        if ($sum > $capital->money) {
            return ['status' => 0, 'msg' => '账户余额不足', 'referer' => '', 'state' => 'fail'];
        }


        try {
            DB::transaction(function () use ($bet_arr, $capital, $sum) {
                DB::table('bets')->insert($bet_arr);
                $capital->money = $capital->money - $sum;
                $capital->save();
            });
        } catch (\Throwable $e) {
            return ['status' => 0, 'msg' => '下注失败,请联系管理员:', 'referer' => '', 'state' => 'fail'];
        }


        return ['status' => 1, 'msg' => '下注成功，请等待开奖', 'referer' => '', 'state' => 'fail'];

    }


    //开奖结果
    public function getLastCodes(Game $game, int $code_id)
    {
        $gameModel = $game->load(['openCodes' => function ($query) use ($code_id) {
            return $query->where('actionNo', $code_id);
        }]);

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
        $result['ptype5'] = '';
        $result['state'] = 'fail';
        return $result;
    }


    //获取开奖时间
    public function getOpenTime(Game $game)
    {

        $game = $game->load(['OpenCodes' => function ($query) {
            return $query->orderBy('created_at', 'desc')->limit('1');
        }]);

        $lastOpen = $game->OpenCodes->first(); //上期开奖

        if ($lastOpen == null) {
            return ['sign' => 'false'];
        }

        $remainTime = strtotime("$lastOpen->open_time +5min") - time();

        $res_arr = [
//            'currExpect' => "97465",
            'currFullExpect' => $lastOpen->actionNo + 1,
//            'lastExpect' => "97464",
            'lastFullExpect' => $lastOpen->actionNo,
            'referer' => "",
            'remainTime' => $remainTime,
            'sign' => "true",
            'state' => "fail",
        ];

        return $res_arr;
    }


    public function getLastCodeList(Game $game)
    {
        $game = $game->load(['openCodes' => function ($query) {
            return $query->orderBy('open_time', 'desc')->limit(10);
        }]);
        $last10 = $game->openCodes;
        $arr['userbetList'] = [];
        $arr['sign'] = 'true';
        $arr['referer'] = '';
        $arr['state'] = 'fail';

        $last10->map(function ($item) use (&$arr) {
            $code_list_arr = explode(',', $item->codes);
            array_push($arr['userbetList'], ['num' => array_sum($code_list_arr)]);
        });


        return $arr;
    }

    public function getLast10(Game $game)
    {
        $gameModel = $game->load(['openCodes' => function ($query) {
            return $query->orderBy('open_time', 'desc')->limit(10);
        }]);

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
            array_push($result, $temp_arr);
        }

        return $result;

    }

}
