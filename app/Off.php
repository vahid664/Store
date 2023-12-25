<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Off extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'user_id',
        'title',
        'code',
        'count',
        'count_use',
        'type_off',
        'price',
        'price_percent',
        'price_factor',
        'date_start',
        'date_end',
        'customer_id',
        'product_id',
        'status',
        'sort',
    ];

    protected $hidden=['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
