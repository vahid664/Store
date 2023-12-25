<?php

namespace App\Http\Resources\Snapp\Product;

use App\Http\Resources\Snapp\Brand\Brand;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            "id"=> $this->id,
            "title"=> $this->title,
            "title_en"=> $this->title_en,
            "link"=> route('product.show',$this->id.'-'.Str::slug($this->title_en)),
            "price" => $this->price,
            "entity" => $this->status == 1 ? $this->entity : 0,
            "status" => $this->status == 1 ? ($this->entity > 0 ? $this->status : 0) : 0,
            "short_text" => $this->short_text,
            "long_text" => $this->long_text,
            "color" => $this->color->count() ? new Colors($this->color) : [],
            "size" => $this->size->count() ? new Sizes($this->size) : [],
            "brand" => $this->brands != '' ? new Brand($this->brands): null,
            "pics" => $this->pics->count() ? new Pics($this->pics) : [],
        ];
    }
}
