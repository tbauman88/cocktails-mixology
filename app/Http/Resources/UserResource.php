<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return collect(parent::toArray($request))->except(["email_verified_at"])->merge([
            "account" => $this->resource->account->only("bio"),
            "drinks" => $this->resource->drinks->map(fn ($drink) => $drink->only("id", "name")),
        ]);
    }
}
