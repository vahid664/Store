<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagProductRelation extends Model
{
    protected $fillable=['product_id','tag_id'];

    public function tag()
    {
        return $this->belongsTo('App\Tag','tag_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id')->where('deleted_at','');
    }
    public function product_exist()
    {
        return $this->belongsTo('App\Product','product_id')
            ->where('entity','>',0)
            ->where('status','<>',0)
            ->whereNull('deleted_at');
    }
}
