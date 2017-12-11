<?php

namespace App\Providers;

use App\Game\Game;
use App\Game\Pc28;
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
            array_push($games, new Pc28());
            return new Game($games);
        });
    }
}
