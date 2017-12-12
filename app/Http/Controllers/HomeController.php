<?php

namespace App\Http\Controllers;


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
        return view('home');
    }
}
