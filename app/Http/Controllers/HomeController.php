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
        $request = \Requests::request('http://cp.360.cn/');
        dd(mb_convert_encoding($request->body, 'utf-8', 'gbk'));

        return view('home');
    }
}
