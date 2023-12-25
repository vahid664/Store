<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetailStructed extends Model
{
    protected $fillable=['product_detail_id','title','text','type','status','sort'];

    public function father()
    {
        return $this->belongsTo('App\ProductDetail','product_detail_id','id')->orderBy('sort');
    }
}
