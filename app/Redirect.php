<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable=[
        'user_id','before','after','type','sort'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
