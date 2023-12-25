<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','title','title_en','text','pic','pic_alt','title_page'
        ,'color','keywords','description','sort','status'];
    protected $hidden=['user_id'];

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function product()
    {
        return $this->hasMany('App\Product','brand_id','id');
    }
}
