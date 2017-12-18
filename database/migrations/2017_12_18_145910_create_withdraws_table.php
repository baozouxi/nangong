<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('money', 10, 2)->unsigned()->comment('提现金额');
            $table->tinyInteger('ok')->default(0)->comment('处理标志');
            $table->integer('card_id')->unsigned()->comment('银行卡ID');
            $table->integer('user_id')->unsigned()->comment('用户ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
