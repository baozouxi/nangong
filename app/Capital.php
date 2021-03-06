<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 资金模型  比较重要 不允许批量插入
 * Class Capital
 * @package App
 */
class Capital extends Model
{

    protected $fillable = ['money'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function logs()
    {
        return $this->hasMany('App\CapitalLog');
    }
}
