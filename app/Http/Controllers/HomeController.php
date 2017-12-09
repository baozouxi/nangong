<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = \Requests::request('http://cp.360.cn/kl8/?menu&r_a=JZFvaq');
        $body = $request->body;
        $str = substr($body, strpos($body, '<div class="aside">'), 1600);
        $str = mb_convert_encoding($str, 'utf-8', 'gbk');
        $str = str_replace(["\r\n", ' '], '', $str);


        $pattern = '/<emid=\'open_issue\'class=\'mark-datered\'>(\d+)<\/em>.*?<ulclass=\'ball-listclearfix\'id=\'open_code_list\'>(<liclass="[^"]+">(\d+)<\/li>)+<\/ul>/';

        $match = [];
        preg_match($pattern, $str, $match,PREG_OFFSET_CAPTURE);
        dd($match);

        print_r($str);
        dd();
        return view('home');
    }
}
