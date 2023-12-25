<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peyk extends Model
{
    protected $fillable=['user_id','date','time_start','time_end','count','price','description','sort'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
