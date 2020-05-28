<?php

namespace App\Http\Resources;

use App\RecipeImage;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\RecipeImage as RecipeImageRecource;

class Recipe extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'ingredients' => $this->ingredients,
            'category'    => new CategoryResource($this->whenLoaded('category')),
            'images'      => RecipeImageRecource::collection($this->whenLoaded('images')),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
