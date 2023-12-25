<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'user_id',
        'price',
        'price_send',
        'trans_id',
        'refrence_id',
        'ntracking',
        'description',
        'status',
        'delivery',
        'post_tracking',
        'comment',
        'status_check',
        'price_online',
        'send_type'
    ];

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function product()
    {
        return $this->hasMany('App\FactorProduct','factor_id')->with('product_details');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function off()
    {
        return $this->belongsTo('App\FactorOff','id','factor_id');
    }
    public function peyk()
    {
        return $this->belongsTo('App\FactorPeyk','id','factor_id');
    }
    public function gift()
    {
        return $this->belongsTo('App\FactorGift','id','factor_id');
    }

    public function returned()
    {
        return $this->hasMany('App\FactorProductReturned','factor_id','id');
    }
}
