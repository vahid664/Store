<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactorOff extends Model
{
    protected $fillable=['factor_id','user_id','off_id','code','type_off','price','price_percent','price_factor'];
}
