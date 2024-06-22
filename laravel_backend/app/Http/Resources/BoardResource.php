<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
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
            'tickets' => TicketResource::collection($this->whenLoaded('tickets')),
            'created_at' => $this->created_at,
        ];
    }
}
