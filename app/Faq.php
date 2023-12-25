<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable=[
        'user_id',
        'question',
        'answer',
        'sort',
        'status',
        'faqable_id',
        'faqable_type',
    ];

    public function faqable()
    {
        return $this->morphTo();
    }
}
