<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class BrandAll extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($q){
                return [
                    "id"=> $q->id,
                    "title"=> $q->title,
                    "title_en"=> $q->title_en,
                    "link"=> url('brand/'.Str::slug($q->title_en)),
                    "language" => 'برند'
                ];
            })
        ];
    }
}
