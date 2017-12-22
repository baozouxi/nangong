<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


//团队控制器
class TeamsController extends Controller
{

    public function index()
    {
        $login = new Login();
        $user = Auth::user();
        $lastLogin = $login->lastLogin($user->id);

        return view('team.index', compact('user', 'lastLogin'));
    }


    public function loadTotalData()
    {
        $str
            = '{"datas":{"draw":[[0,0],[1,0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0],[13,0],[14,0],[15,0],[16,0],[17,0],[18,0],[19,0],[20,0],[21,0],[22,0],[23,0]],"charge":[[0,0],[1,0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0],[13,0],[14,0],[15,0],[16,0],[17,0],[18,0],[19,0],[20,0],[21,0],[22,0],[23,0]],"bet":[[0,0],[1,0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0],[13,0],[14,0],[15,0],[16,0],[17,0],[18,0],[19,0],[20,0],[21,0],[22,0],[23,0]],"point":[[0,0],[1,0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0],[13,0],[14,0],[15,0],[16,0],[17,0],[18,0],[19,0],[20,0],[21,0],[22,0],[23,0]],"user":[[0,0],[1,0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0],[13,0],[14,0],[15,0],[16,0],[17,0],[18,0],[19,0],[20,0],[21,0],[22,0],[23,0]]},"total":{"withdraw":0,"load":0,"buy":0,"rebates":0,"newMem":0},"model":"h","sTime":"2017-12-15","eTime":"2017-12-15","status":"ok","referer":"","state":"success"}';

        return json_decode($str, true);

    }

    public function manager()
    {
        $login = new Login();
        $user = Auth::user();
        $lastLogin = $login->lastLogin($user->id);

        return view('team.manager', compact('user', 'lastLogin'));
    }

    public function loadManager()
    {
        $str
            = '{"list":"<li class=\"first\"> <div class=\"yxmc\">\u7528\u6237\u540d<\/div> <div class=\"yl\">\u8d26\u6237\u4f59\u989d<\/div> <div class=\"yl\">\u72b6\u6001<\/div> <div class=\"gl\">\u8fd4\u70b9(%)<\/div> <div class=\"gl\">\u8d21\u732e\u8fd4\u70b9<\/div> <div class=\"gl\">\u4e0b\u6ce8\u603b\u91d1\u989d<\/div> <div class=\"time\">\u6700\u540e\u767b\u5f55\u65f6\u95f4<\/div> <\/li>","page":"1","count":"0","pageSize":10,"referer":"","state":"fail"}';

        return json_decode($str, true);

    }


    public function popularize()
    {
        $login = new Login();
        $user = Auth::user();
        $lastLogin = $login->lastLogin($user->id);

        return view('team.popularize', compact('user', 'lastLogin'));
    }

}
