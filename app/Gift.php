<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'user_id',
        'product_id',
        'title',
        'count',
        'count_use',
        'floor_price_basket',
        'text',
        'date_start',
        'date_end',
        'status',
        'sort'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
