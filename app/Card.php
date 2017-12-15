<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//银行卡号
class Card extends Model
{

    protected $fillable = ['number', 'user_id', 'bank_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

}
