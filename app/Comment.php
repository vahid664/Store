<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'user_id',
        'parent',
        'title',
        'name',
        'email',
        'text',
        'accept',
        'vote',
        'status',
        'admin_id',
        'commentable_id',
        'commentable_type',
        'sort',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function child()
    {
        return $this->hasMany('App\Comment','parent','id')->where('status',1)->orderBy('sort');
    }
}
