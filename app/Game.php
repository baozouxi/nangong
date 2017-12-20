<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name'];


    public function openCodes()
    {
        return $this->hasMany('App\OpenCode');
    }

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

    public function guesses()
    {
        return $this->hasMany('App\Guess');
    }

}
