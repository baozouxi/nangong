<?php

namespace App\Providers;

use App\Game\Canada;
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
            $games[$pc28->name()] = $pc28;
            $games[$pc28v25->name()] = $pc28v25;
            $games[$canada->name()] = $canada;
            return new Game($games);
        });
    }
}
