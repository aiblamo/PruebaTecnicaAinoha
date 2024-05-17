<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->name,
            'descripcion' => $this->description,
            'foto' => $this->photo,
            'precios' => ProductPriceResource::collection($this->prices),
            'categoria' => CategoryResource::collection($this->categories),
            'vendedor'=>[
                'name'=>$this->user->name,
                
        ],
        ];
    }
}