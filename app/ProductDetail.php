<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable=['product_id','type','title','sort'];

    public function structed()
    {
        return $this->hasMany('App\ProductDetailStructed','product_detail_id','id')->orderBy('sort');
    }
}
