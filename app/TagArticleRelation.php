<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagArticleRelation extends Model
{
    protected $fillable=['tag_id','article_id'];
    public function tag()
    {
        return $this->belongsTo('App\Tag','tag_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Article','article_id');
    }
}
