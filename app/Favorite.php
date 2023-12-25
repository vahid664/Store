<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable=['user_id','product_id'];
    protected $hidden=['user_id'];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id')->where('status','<>',0);
    }
}
