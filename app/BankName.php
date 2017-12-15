<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    protected $fillable = ['name', 'user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function banks()
    {
        return $this->hasMany('App\Bank');
    }
}
