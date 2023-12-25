<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertise extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','title','title_en','description','pic','pic_alt','url','where_page','location','size'
        ,'status','sort','platform_status','type_open','date_start','date_end','ads_type','banner_type','button_title'];

    protected $hidden=['user_id'];

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }
}
