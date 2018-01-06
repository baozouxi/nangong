<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'phone','money_password','enable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function login()
    {
        return $this->hasMany('App\Login');
    }

    public function capital()
    {
        return $this->hasOne('App\Capital');
    }

    public function capitalLogs()
    {
        return $this->hasMany('App\CapitalLog');
    }


    public function bankName()
    {
        return $this->hasOne('App\BankName');
    }


    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    public function withdraws()
    {
       return $this->hasMany('App\Withdraw');
    }



    //用户是否为代理 表为 agents
    public function agent()
    {
        return $this->hasOne('App\Agent');
    }


    //上线 表为 agent_user
    public function leader()
    {
        return $this->belongsToMany('App\Agent');
    }

}
