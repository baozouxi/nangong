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
        $result['ptype5'] = '';
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
            array_push($result, $temp_arr);
        }

        return $result;

    }


    //反水  逻辑还不清楚 暂时弄个假象
    public function fanshui(Game $game)
    {
        $str
            = '{"list":"<div class=\"yxzxwqkq\"> <ul> <li class=\"first\"> <div class=\"w172\">\u65e5\u671f<\/div> <div class=\"w201\">\u7ec4\u5408\u6bd4\u4f8b<\/div> <div class=\"w186\">\u76c8\u4e8f<\/div> <div class=\"w149\">\u72b6\u6001<\/div> <div class=\"w244\">\u8fd4\u6c34<\/div> <\/li> <li style=\"line-height:20px; color:#888; padding:10px 0;\">\u5907\u6ce8\uff1a1\u3001\u8f93600\u4ee5\u4e0a\/\u4e0b\u6ce815\u628a\u4ee5\u4e0a; 2\u3001\u56de\u6c3410%\u8f931\u4e07\u4ee5\u4e0a12%; 3\u3001\u5f53\u5929\u8f93\u94b1\u6b21\u65e5\u51cc\u66682\u70b9\u524d\u7533\u8bf7\u56de\u6c34\u6709\u6548; 4\u3001\u8d85\u65f6\u65e0\u6cd5\u7533\u8bf7\uff0c\u4e0d\u53ef\u8865; 5\u3001\u5f53\u65e5\u7533\u8bf7\u56de\u6c34\u540e\u4e0d\u53ef\u4e0b\u6ce8\uff0c\u4e0b\u6ce8\u540e\u56de\u6c34\u4f1a\u88ab\u53d6\u6d88\uff01 <\/li> <\/ul> <\/div> <div class=\"pagination\"><\/div>","page":"1","count":0,"pageSize":10,"referer":"","state":"fail"}';

        return json_decode($str, true);
    }


    public function zoushi(Game $game)
    {
        $str
            = '{"list":"<div class=\"yxzxkqzs\"> <table  width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\"> <tbody> <tr> <th>\u671f\u53f7<\/th> <th>0<\/th> <th>1<\/th> <th>2<\/th> <th>3<\/th> <th>4<\/th> <th>5<\/th> <th>6<\/th> <th>7<\/th> <th>8<\/th> <th>9<\/th> <th>10<\/th> <th>11<\/th> <th>12<\/th> <th>13<\/th> <th>14<\/th> <th>15<\/th> <th>16<\/th> <th>17<\/th> <th>18<\/th> <th>19<\/th> <th>20<\/th> <th>21<\/th> <th>22<\/th> <th>23<\/th> <th>24<\/th> <th>25<\/th> <th>26<\/th> <th>27<\/th> <th>\u5927<\/th> <th>\u5c0f<\/th> <th>\u5355<\/th> <th>\u53cc<\/th> <th>\u5927\u5355<\/th> <th>\u5c0f\u5355<\/th> <th>\u5927\u53cc<\/th> <th>\u5c0f\u53cc<\/th> <th>\u6781\u5927<\/th> <th>\u6781\u5c0f<\/th> <\/tr> <tr> <td>861309<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >8<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_bfc200\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861308<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_f34b2f\" >14<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_c27400\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861307<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >9<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_00c22c\"\u3000>\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861306<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >9<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_00c22c\"\u3000>\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861305<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >20<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_c27400\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861304<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >9<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_00c22c\"\u3000>\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861303<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td class=\"bj_f34b2f\" >11<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_00c22c\"\u3000>\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861302<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >6<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_bfc200\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861301<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >22<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_c27400\" >\u2022<\/td> <td  ><\/td> <td class=\"bj_6400ff\" >\u2022<\/td> <td  ><\/td> <\/tr><tr> <td>861300<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_4688d1\" >18<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_c27400\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861299<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_f34b2f\" >16<\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td class=\"bj_c27400\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861298<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >3<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_00c22c\"\u3000>\u2022<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_0090ff\" >\u2022<\/td> <\/tr><tr> <td>861297<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_f34b2f\" >12<\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td ><\/td> <td class=\"bj_ff00e9\" >\u5c0f<\/td> <td \u3000><\/td> <td class=\"bj_b200ff\"\u3000>\u53cc<\/td> <td  ><\/td> <td \u3000><\/td> <td  ><\/td> <td class=\"bj_bfc200\" >\u2022<\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861296<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_f34b2f\" >15<\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td class=\"bj_ff0079\" >\u2022<\/td> <td \u3000><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <\/tr><tr> <td>861295<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_4688d1\" >25<\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ecf3fa\" ><\/td> <td class=\"bj_ffc300\">\u5927<\/td> <td  ><\/td> <td class=\"bj_ff9300\"\u3000>\u5355<\/td> <td \u3000><\/td> <td class=\"bj_ff0079\" >\u2022<\/td> <td \u3000><\/td> <td  ><\/td> <td  ><\/td> <td class=\"bj_6400ff\" >\u2022<\/td> <td  ><\/td> <\/tr> <\/tbody> <\/table> <\/div> <div class=\"pagination\"><\/div>","page":"1","count":"34686","pageSize":15,"referer":"","state":"fail"}';

        return json_decode($str, true);
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

        foreach ($bets as $bet) {
            $temp_arr = [];
            $state = '0';
            $temp_arr['billno'] = $bet->id;
            $temp_arr['expect'] = $bet->actionNo;
            $temp_arr['betsTimes'] = $bet->created_at->__toString();
            $temp_arr['code'] = $bet->code;
            $temp_arr['betsMoney'] = $bet->money;
            $temp_arr['prizeMoney'] = $bet->profit;

            if ($bet->lotteried == 1) {
                $state = '1';
            }

            if ($bet->profit > 0) {
                $state = '2';
            }
            $temp_arr['state'] = $state;

            array_push($userBetList, $temp_arr);
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
            $str .= '<div class="w186">'.$user_count[$bet['expect']].'</div>';
            $str .= ' <div class="w149">'.$expect_money_sum[$bet['expect']]
                .'</div>';
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
