<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{

    /**
     * pc28
     * 游戏展示页面
     * @param Request $request
     *
     */
    public function pc28(Request $request)
    {
        return view('game.index');
    }


    public function getLastCodes()
    {
        $arr = json_decode('{"full_expect":"860267","open_code":"01,02,16,17,18,20,22,25,27,31,35,36,37,39,52,57,73,74,75,80+02","open_time":"2017-12-07 16:55:00","open_time_stamp":1512636900,"num1":"4","num2":"6","num3":"2","str_num":"4,6,2","sum":12,"num4":12,"ptype1":"\u5c0f\u53cc","ptype2":"\u5c0f","ptype3":"\u53cc","ptype5":"","add_time":1512636911,"expect":"860267","sign":"true","referer":"","state":"fail"}', true);


        return $arr;


    }


    public function getOpenTime()
    {
        $res_arr = [
            'currExpect' => "97363",
            'currFullExpect' => "860273",
            'lastExpect' => "97362",
            'lastFullExpect' => "860273",
            'referer' => "",
            'remainTime' => 159,
            'sign' => "true",
            'state' => "fail",
        ];

        return $res_arr;
    }


    public function getLastCodeList()
    {
        $arr = '{"userbetList":[{"num":"17"},{"num":"12"},{"num":"8"},{"num":"7"},{"num":"17"},{"num":"23"},{"num":"21"},{"num":"9"},{"num":"10"},{"num":"10"}],"sign":"true","referer":"","state":"fail"}';
        $arr = json_decode($arr, true);

        return $arr;
    }

    public function getLast10()
    {

    }

}
