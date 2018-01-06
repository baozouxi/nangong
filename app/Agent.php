<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//代理模型
class Agent extends Model
{
    protected $fillable = ['user_id', 'tips', 'point'];



    public function user()
    {
       return $this->belongsTo('App\User');
    }


    public function followers()
    {
        return $this->belongsToMany('App\User');
    }


    public function moneyLog()
    {
        return $this->hasMany('App\AgentMoney');
    }

}
