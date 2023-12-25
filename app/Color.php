<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','title','color','sort','parent','title_factory'];

    protected $hidden=['user_id'];
    public function child()
    {
        return $this->hasMany('App\Color','parent','id');
    }
}
