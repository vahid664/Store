<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryRelation extends Model
{
    protected $fillable=['product_id','category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
