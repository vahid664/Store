<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'user_id',
        'category_id',
        'title',
        'title_en',
        'text',
        'keywords',
        'description',
        'status',
        'sort'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
