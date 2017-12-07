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



}
