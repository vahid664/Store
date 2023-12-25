<?php

namespace App\Http\Resources\Snapp\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Colors extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'data' => $this->collection->transform(function($q){
                return [
                    "title"=> $q->title,
                    "color"=> $q->color,
                    "title_factory"=> $q->title_factory,
                ];
            })
        ];
    }
}
