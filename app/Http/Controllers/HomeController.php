<?php

namespace App\Http\Controllers;


use App\Article;
use App\Bet;
use App\Events\AwardPrizes;
use App\Game\Game;
use App\OpenCode;

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

        $articles = Article::limit(5)->orderBy('created_at', 'desc')->get();

        return view('home', compact('articles'));
    }

    public function articles()
    {
        $articles = Article::all();
    }


    public function tuiguang()
    {
        return view('tuiguang');
    }


    public function ces()
    {
        $request = \Requests::request('http://lotto.bclc.com/services2/keno/draw/latest/today');

        $codes_list = json_decode($request->body, true);

        $codes = array_shift($codes_list);

        $codes['drawNbrs'] = array_sort($codes['drawNbrs']);

        $temp_arr = [];
        $temp_arr[0] = 0;
        $temp_arr[1] = 0;
        $temp_arr[2] = 0;
        for ($i=0; $i<3; $i++) {
            $current = $i+1;
            for ($j=0;$j<=5;$j++) {
                $temp_arr[$i] += $codes['drawNbrs'][$current];
                $current += 3;
            }
            $temp_arr[$i] = substr((string)$temp_arr[$i], -1, 1);
        }


        $result = [];
        $result['codes'] = implode(',', $temp_arr);
        $result['actionNo'] = $codes['drawNbr'];
        $result['open_time'] = date('Y-m-d H:i:s', time());

        return $result;

    }


}
