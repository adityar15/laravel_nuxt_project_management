<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\BoardResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'boards' => BoardResource::collection($this->whenLoaded('boards')),
            'created_at' => $this->created_at,
        ];
    }
}
