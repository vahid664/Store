<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactorGift extends Model
{
    protected $fillable=[
        'factor_id',
        'user_id',
        'gift_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function gift()
    {
        return $this->belongsTo('App\Gift','gift_id');
    }

}
