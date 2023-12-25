<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FactorProductReturned extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'factor_id',
        'product_id',
        'price',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
