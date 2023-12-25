<?php

namespace App\Http\Resources\Snapp\Product;

use App\Http\Resources\Snapp\Brand\Brand;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class Products extends ResourceCollection
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
                    "id"=> $q->id,
                    "title"=> $q->title,
                    "title_en"=> $q->title_en,
                    "link"=> route('product.show',$q->id.'-'.Str::slug($q->title_en)),
                    "price" => $q->price,
                    "entity" => $q->status == 1 ? $q->entity : 0,
                    "status" => $q->status == 1 ? ($q->entity > 0 ? $q->status : 0) : 0,
                    "short_text" => $q->short_text,
                    "long_text" => $q->long_text,
                    "color" => $q->color->count() ? new Colors($q->color) : [],
                    "size" => $q->size->count() ? new Sizes($q->size) : [],
                    "brand" => $q->brands != '' ? new Brand($q->brands): null,
                    "pics" => $q->pics->count() ? new Pics($q->pics) : [],
                ];
            }),
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
        ]];
    }
}
