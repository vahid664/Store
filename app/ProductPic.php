<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPic extends Model
{
    protected $fillable=['user_id','product_id','title','link','type','sort'];

    protected $hidden=['user_id'];

    public function color()
    {
        return $this->belongsTo('App\PicColorRelation','pic_id','id');
    }
}
