<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//开奖记录模型
class OpenCode extends Model
{
    protected $fillable = ['codes','open_time', 'game_id','actionNo'];


    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

}
