<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=[
        'name',
        'mobile',
        'comment',
        'status',
        'user_id',
    ];
}
