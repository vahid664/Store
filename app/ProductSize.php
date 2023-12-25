<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable=['product_id','title','sort','price','price_discount','entity','colors','status','position'];
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
