<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $data = $this->resource->toArray();

        return ['id' => $data['name'], 'title' => $data['title']];
    }
}
