<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            // Expose both `type` (DB column) and `species` for compatibility.
            'type' => $this->type ?? $this->species ?? null,
            'species' => $this->type ?? $this->species ?? null,
        ];
    }
}
