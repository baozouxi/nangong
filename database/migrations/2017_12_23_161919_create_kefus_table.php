<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKefusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kefus', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('way');
            $table->tinyInteger('type')->unsigned()->default(1)->commet('1=>客服 2=>qq群');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kefus');
    }
}
