<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentMoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->float('money', 10,2)->unsigned()->comment('用户充值金额');
            $table->float('profit', 10,2)->unsigned()->comment('代理提现金额');
            $table->float('point', 10,5)->unsigned()->comment('代理提现点数');
            $table->integer('agent_id')->unsinged();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_moneys');
    }
}
