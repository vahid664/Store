<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable=['user_id','avatar','avatar_flag','news_receive','national_code','sex','bill','bill_cart'
        ,'birthday_year','birthday_month','birthday_day','status'];
}
