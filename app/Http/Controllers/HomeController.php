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
//        $request = \Requests::request('http://lotto.bclc.com/services2/keno/draw/latest/today');
//
//        dd(json_decode($request->body,true));


        $articles = Article::limit(5)->orderBy('created_at', 'desc')->get();

        return view('home', compact('articles'));
    }

    public function articles()
    {
        $articles = Article::all();


    }



}
