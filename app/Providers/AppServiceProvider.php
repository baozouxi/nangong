<?php

namespace App\Providers;

use App\Ad;
use App\Game;
use App\Kefu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(190);

        View::composer('admin.layout', function ($view) {
            $games = Game::all();

            return $view->with('games', $games);
        });

        View::composer(['layouts.app','auth.login'], function ($view) {
            $ad = Ad::first();

            $kefus = Kefu::all();


            return $view->with(['ad'=>$ad, 'kefus'=>$kefus]);

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
