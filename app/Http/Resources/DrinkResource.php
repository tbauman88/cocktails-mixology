<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrinkResource extends JsonResource
{
//    /** @param Request $request */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'owner' => $this->resource->user->name,
            'ingredients' => $this->resource->ingredients->map(function ($ingredient) {
                return $ingredient->name;
            }),
            'published' => $this->resource->published,
            'saveCount' => $this->resource->save_count,
            "created_at" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at
        ];
    }
}
