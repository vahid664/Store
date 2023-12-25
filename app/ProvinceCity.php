<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProvinceCity extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','parent','title','sort'];

    public function childern()
    {
        return $this->hasMany('App\ProvinceCity','parent','id')->orderBy('sort');
    }
}
