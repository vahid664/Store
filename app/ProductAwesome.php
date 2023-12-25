<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAwesome extends Model
{
    use SoftDeletes;

    protected $fillable=['user_id','product_id','date_start','date_end',
        'price_percent','price','entity','sort','title','hour_start','hour_end'];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id')->with(['picfirst','color','brands']);
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getDateEndExplodeAttribute()
    {
        return explode('/',$this->date_end);
    }
    public function getDateStartExplodeAttribute()
    {
        return explode('/',$this->date_start);
    }
}
