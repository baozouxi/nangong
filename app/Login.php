<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Login
 * 登录次数模型
 * @package App
 */
class Login extends Model
{
    public $timestamps = false;


    public function lastLogin($user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('login_time', 'desc')->first();
    }


}
