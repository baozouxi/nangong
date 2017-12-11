<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

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
        $game = Game::where('name','北京幸运28')->firstOrFail();

        return view('game.index',['game_id'=>$game->id]);
    }


    //下注界面
    public function pc28Play()
    {
        return view('game.play');
    }


    public function getLastCodes()
    {
        $arr = json_decode('{"full_expect":"860369","open_code":"01,02,16,17,18,20,22,25,27,31,35,36,37,39,52,57,73,74,75,80+02","open_time":"2017-12-07 16:55:00","open_time_stamp":1512636900,"num1":"4","num2":"6","num3":"2","str_num":"4,6,2","sum":12,"num4":12,"ptype1":"\u5c0f\u53cc","ptype2":"\u5c0f","ptype3":"\u53cc","ptype5":"","add_time":1512636911,"expect":"860369","sign":"true","referer":"","state":"fail"}', true);

        return $arr;

    }


    public function getOpenTime(Game $game)
    {

        $game = $game->load(['OpenCodes' => function ($query) {
            return $query->orderBy('created_at', 'desc')->limit('1');
        }]);

        $lastOpen = $game->OpenCodes->first(); //上期开奖

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
        $game = $game->load(['openCodes'=>function($query){
            return $query->orderBy('open_time','desc')->limit(10);
        }]);
        $last10 = $game->openCodes;
        $arr['userbetList'] = [];
        $arr['sign'] = 'true';
        $arr['referer'] = '';
        $arr['state'] = 'fail';

        $last10->map(function($item)use(&$arr){
            $code_list_arr = explode(',',$item->codes);
            array_push($arr['userbetList'], ['num'=>array_sum($code_list_arr)]);
        });


        return $arr;
    }

    public function getLast10(Game $game)
    {
        $str = '[{"num1":"8","num2":"4","num3":"6","num4":"18","expect":"860368","ptype1":"\u5927\u53cc","ptype2":"\u5927","ptype3":"\u53cc","ptype5":""},{"num1":"0","num2":"2","num3":"8","num4":"10","expect":"860367","ptype1":"\u5c0f\u53cc","ptype2":"\u5c0f","ptype3":"\u53cc","ptype5":""},{"num1":"2","num2":"7","num3":"7","num4":"16","expect":"860366","ptype1":"\u5927\u53cc","ptype2":"\u5927","ptype3":"\u53cc","ptype5":"\u5bf9\u5b50"},{"num1":"7","num2":"3","num3":"6","num4":"16","expect":"860365","ptype1":"\u5927\u53cc","ptype2":"\u5927","ptype3":"\u53cc","ptype5":""},{"num1":"5","num2":"2","num3":"6","num4":"13","expect":"860364","ptype1":"\u5c0f\u5355","ptype2":"\u5c0f","ptype3":"\u5355","ptype5":""},{"num1":"3","num2":"3","num3":"1","num4":"7","expect":"860363","ptype1":"\u5c0f\u5355","ptype2":"\u5c0f","ptype3":"\u5355","ptype5":"\u5bf9\u5b50"},{"num1":"5","num2":"9","num3":"2","num4":"16","expect":"860362","ptype1":"\u5927\u53cc","ptype2":"\u5927","ptype3":"\u53cc","ptype5":""},{"num1":"9","num2":"3","num3":"1","num4":"13","expect":"860361","ptype1":"\u5c0f\u5355","ptype2":"\u5c0f","ptype3":"\u5355","ptype5":""},{"num1":"1","num2":"3","num3":"7","num4":"11","expect":"860360","ptype1":"\u5c0f\u5355","ptype2":"\u5c0f","ptype3":"\u5355","ptype5":""},{"num1":"6","num2":"9","num3":"6","num4":"21","expect":"860359","ptype1":"\u5927\u5355","ptype2":"\u5927","ptype3":"\u5355","ptype5":"\u5bf9\u5b50"}]';
        $arr = json_decode($str);
        return json_encode($arr);

    }

}
