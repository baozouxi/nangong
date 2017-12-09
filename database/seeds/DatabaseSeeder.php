<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [['name' => \App\Game\Pc28::NAME]];

        array_map(function ($game) {
            \App\Game::create($game);
        }, $games);


        $this->call(UsersSeeder::class);

    }
}
