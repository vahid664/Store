<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','brand_id','title','title_en','keywords','description','short_text','long_text'
        ,'price_send','origin','deliver','warranty','price_type','price','price_percent','entity','before','after'
        ,'visit','index','status','sort','flag_pic_thumbnail','price_self_buy','title_page','shoulder'];

    protected $hidden=['user_id'];

    public function getLastPriceAttribute()
    {
        if ($this->price_type == 1)
        {
            return $this->price;
        }
        elseif($this->price_type == 2)
        {
            return $this->price - ($this->price_percent*($this->price/100));
        }
        else
        {
            return 1000000000;
        }
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable')->where('status',1);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status',1);
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function awesome()
    {
        return $this->belongsTo('App\ProductAwesome','id','product_id');
    }

    public function scopeActive($q)
    {
        return $q->where('status','<>',0);
    }

    public function tag_rel()
    {
        return $this->hasMany('App\TagProductRelation','product_id')->with('tag');
    }

    public function brands()
    {
        return $this->belongsTo('App\Brand','brand_id');
    }

    public function pics()
    {
        return $this->hasMany('App\ProductPic','product_id')->orderBy('sort');
    }

    public function picfirst()
    {
        return $this->hasOne('App\ProductPic','product_id')->orderBy('sort')->oldest();
    }

    public function size_first()
    {
        return $this->hasOne('App\ProductSize','product_id')->oldest();
    }

    public function size()
    {
        return $this->hasMany('App\ProductSize','product_id');
    }

    public function size_active()
    {
        return $this->hasOne('App\ProductSize','product_id')->where('status',1)->oldest();
    }

    public function color()
    {
        return $this->hasMany('App\ProductColor','product_id');
    }

    public function detail_first()
    {
        return $this->hasOne('App\ProductDetail','product_id')->orderBy('sort')->oldest();
    }

    public function detail()
    {
        return $this->hasMany('App\ProductDetail','product_id')->orderBy('sort');
    }

    public function category_first()
    {
        return $this->hasOne('App\ProductCategoryRelation','product_id')->oldest();
    }
	public function category_last()
    {
        return $this->hasOne('App\ProductCategoryRelation','product_id')->orderByDesc('category_id')->oldest();
    }
    public function category_rel()
    {
        return $this->hasMany('App\ProductCategoryRelation','product_id');
    }
}
