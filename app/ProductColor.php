<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $fillable=['product_id','title','color','sort','title_factory'];

    public function pic()
    {
        return $this->belongsTo('App\PicColorRelation','id','color_id');
    }
}
