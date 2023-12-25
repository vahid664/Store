<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','parent','title','value','sort'];
    protected $hidden=['user_id'];

    public function child()
    {
        return $this->hasMany('App\Size','parent','id');
    }
}
