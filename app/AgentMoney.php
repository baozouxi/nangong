<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//代理提成模型
class AgentMoney extends Model
{

    protected $fillable = ['user_id', 'agent_id', 'point', 'money', 'profit'];

    public function agent()
    {
        return $this->belongsTo('App\Agent');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }



}
