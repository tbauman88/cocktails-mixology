<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DrinkResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'description' => $this->resource->description ?? "",
            'owner' => $this->resource->user->name,
            'ingredients' => $this->resource->ingredients->map(fn ($ingredient) => [
                'name' => $ingredient->name,
                'amount' => $ingredient->pivot->amount . ' ' . $ingredient->pivot->amount_unit
            ]),
            'public' => $this->resource->published ?: false,
            'saveCount' => $this->resource->save_count ?: 0,
            "created_at" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at
        ];
    }
}
