<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Brand extends JsonResource
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
            "link"=> url('brand/'.Str::slug($this->title_en)),
            "language" => 'برند'
        ];
    }
}
