<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','title','title_en','text','status','sort'];

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function product_rel()
    {
        return $this->hasMany('App\TagProductRelation','tag_id');
    }



    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
