<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes,HasRoles,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','family','mobile','level','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->family;
    }

    public function address_first()
    {
        return $this->hasOne('App\UserAddress','user_id')->where('status',1)->oldest();
    }

    public function address()
    {
        return $this->hasMany('App\UserAddress','user_id');
    }

    public function detail()
    {
        return $this->belongsTo('App\UserDetail','id','user_id');
    }

    public function favorite()
    {
        return $this->hasMany('App\Favorite','user_id');
    }
}
