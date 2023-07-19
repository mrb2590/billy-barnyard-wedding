<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Party extends JsonResource
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
            'name' => $this->name,
            'rsvp_code' => $this->rsvp_code,
            'address' => $this->address,
            'message_to_party' => $this->message_to_party,
            'message_from_party' => $this->message_from_party,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'guests' => Guest::collection($this->whenLoaded('guests')),
            'guests_count' => $this->whenCounted('guests')
        ];
    }
}
