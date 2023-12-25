<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','category_id','title','title_en','keywords','description','short_text'
        ,'long_text','period','before','after','visit','index','status','sort'];

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status',1);
    }

    public function tag_rel()
    {
        return $this->hasMany('App\TagArticleRelation','Article_id')->with('tag');
    }

    public function pics()
    {
        return $this->hasMany('App\ArticlePic','article_id');
    }

    public function picfirst()
    {
        return $this->hasOne('App\ArticlePic','article_id')->oldest();
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    public function bef()
    {
        return $this->belongsTo('App\Article','before')->active()->select('id','title','title_en');
    }

    public function af()
    {
        return $this->belongsTo('App\Article','after')->active()->select('id','title','title_en');
    }
}
