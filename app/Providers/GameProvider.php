<?php

namespace App\Providers;

use App\Game\Canada;
use App\Game\Canadav25;
use App\Game\Canadav28;
use App\Game\Game;
use App\Game\Pc28;
use App\Game\Pc28v25;
use Illuminate\Support\ServiceProvider;

class GameProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Game::class, function () {
            $games = [];
            $pc28 = new Pc28();
            $pc28v25 = new Pc28v25();
            $canada = new Canada();
            $canadav25 = new Canadav25();
            $canadav28 = new Canadav28();
            $games[$pc28->name()] = $pc28;
            $games[$pc28v25->name()] = $pc28v25;
            $games[$canada->name()] = $canada;
            $games[$canadav25->name()] = $canadav25;
            $games[$canadav28->name()] = $canadav28;
            return new Game($games);
        });
    }
}
