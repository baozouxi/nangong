<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_times', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('actionTime')->comment('开奖时间');
            $table->integer('actionNo')->comment('开奖期号');
            $table->integer('game_id')->unsigned()->comment('游戏id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_times');
    }
}
