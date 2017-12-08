<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('open_time')->comment('开奖时间');
            $table->string('codes')->comment('开奖号码');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_codes');
    }
}
