<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guess extends Model
{
    protected $fillable = ['user_id', 'game_id', 'actionNo', 'number', 'money','profit', 'lotteried'];

    Const PRISE = 2; //中奖标志
    Const UNPRISE = 1; //未中奖


    public function game()
    {
        return $this->belongsTo('App\Game');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
