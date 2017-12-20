<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//开奖记录模型
class OpenCode extends Model
{
    protected $fillable = ['codes', 'open_time', 'game_id', 'actionNo'];


    public function bets()
    {
        return $this->hasMany('App\Bet');
    }


    //获取最新一期期号
    public function lastExpect()
    {

    }


    //当前期号
    public function currentExpect($game_id)
    {
        $codes = $this->where('game_id', $game_id)->orderBy('open_time', 'desc')
            ->first();

        return $codes->actionNo + 1;

    }
}
