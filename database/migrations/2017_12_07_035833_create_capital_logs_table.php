<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitalLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capital_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('capital_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->float('money', 10, 2)->unsigned();
            $table->enum('type', ['1','2'])->comment('1=> 充值， 2=>提现');
            $table->tinyInteger('ok')->unsigned()->default(0)->comment('是否到账');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capital_logs');
    }
}
