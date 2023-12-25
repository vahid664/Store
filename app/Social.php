<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','title','pic','url','description','type','sort','status'];
    protected $hidden=['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
