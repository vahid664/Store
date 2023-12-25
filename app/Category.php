<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','parent','title','title_en','text','pic','pic_alt'
        ,'color','keywords','description','sort','status','menu','title_page','type','short_text'];

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable')->where('status',1);
    }

    protected $hidden=['user_id'];

    public function scopeMenu($q)
    {
        return $q->where('menu',1);
    }

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function scopeParent($q)
    {
        return $q->where('parent',0);
    }

    public function product_rell()
    {
        return $this->hasMany('App\ProductCategoryRelation','category_id','id');
    }

    public function parents()
    {
        return $this->belongsTo('App\Category','parent')->scopes('menu');
    }

    public function childern()
    {
        return $this->hasMany('App\Category','parent','id')->scopes('menu')->orderBy('sort');
    }
    public function childern_all()
    {
        return $this->hasMany('App\Category','parent','id')->orderBy('sort');
    }
}
