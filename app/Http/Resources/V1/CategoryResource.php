<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'nombre' => $this->name,
            'description'=>$this->description,
            'categoria_padre' => $this->getParentCategoryName(),
        ];
    }

    /**
     * Get the parent category name if exists.
     *
     * @return string|null
     */
    protected function getParentCategoryName()
    {
        if ($this->parent_id) {
            $parentCategory = self::find($this->parent_id);
            return $parentCategory ? $parentCategory->name : null;
        }

        return null;
    }
}
