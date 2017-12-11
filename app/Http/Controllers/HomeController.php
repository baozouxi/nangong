<?php

namespace App\Http\Controllers;


use App\Game\Game;

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

        app()->make(Game::class)->getCodes();

        return view('home');
    }
}
