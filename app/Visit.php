<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable=[
        'user_id',
        'ip',
        'system',
        'system_vertion',
        'browser',
        'browser_vertion',
        'url',
        'product_id',
        'article_id',
        'time_start',
        'time_end',
        'session_id'
    ];
}
