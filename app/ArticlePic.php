<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlePic extends Model
{
    protected $fillable=['article_id','title','link','type','sort'];
}
