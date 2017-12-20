<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guesses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('number')->unsigned()->comment('猜测数字');
            $table->integer('actionNo')->unsigned()->comment('期号');
            $table->float('money', 10, 2)->unsigned()->comment('投注金额');
            $table->float('profit', 10, 2)->unsigned()->default(0)->comment('奖励金额');
            $table->tinyInteger('lotteried')->unsigned()->default(0)->comment('开奖标志');
            $table->integer('user_id')->unsigned()->comment('userId');
            $table->integer('game_id')->unsigned()->comment('gameId');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guesses');
    }
}
