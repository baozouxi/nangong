<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('game_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('actionNo')->comment('下注期号');
            $table->float('money', 10, 2)->unsigned()->comment('下注金额');
            $table->string('code')->comment('下注号码');
            $table->tinyInteger('lotteried')->default(0)->comment('是否开奖');
            $table->float('profit', '10', 2)->unsigned()->default(0.00)->comment('盈利');
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
        Schema::dropIfExists('bets');
    }
}
