<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 财务记录
 * Class CapitalLog
 * @package App
 */
class CapitalLog extends Model
{
    const  RECHARGE = 1; //充值type
    const  WITHDRAW = 2; //提现

    protected $fillable = ['user_id', 'capital_id', 'money', 'type','ok'];


    public function capital()
    {
        return $this->belongsTo('App\Capital');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
