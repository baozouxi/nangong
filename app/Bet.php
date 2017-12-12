<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

//下注模型
class Bet extends Model
{

    protected $fillable = ['game_id', 'user_id', 'money', 'code'];


    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
