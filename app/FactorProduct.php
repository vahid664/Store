<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactorProduct extends Model
{
    protected $fillable=[
        'factor_id',
        'product_id',
        'price_type',
        'price',
        'price_percent',
        'count',
        'color',
        'size',
    ];

    public function product_details()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
