<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    protected $fillable = [
        'product_id',
        'price_observed',
        'url_address',
        'ip',
        'os',
        'status'
    ];


    public function product(){
        return $this->belongsTo(Product::class ,'product_id' , 'id' );
    }
}
