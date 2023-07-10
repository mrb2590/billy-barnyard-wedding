<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Guest extends JsonResource
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
            'party_id' => $this->party_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'is_child' => $this->is_child,
            'is_guest' => $this->is_guest,
            'is_attending' => $this->is_attending,
            'has_rehearsal_invite' => $this->has_rehearsal_invite,
            'is_attending_rehearsal' => $this->is_attending_rehearsal,
            'side' => $this->side,
            'relation' => $this->relation,
            'message_to_guest' => $this->message_to_guest,
            'message_from_guest' => $this->message_from_guest,
            'notes' => $this->notes,
            'rsvp_responded_at' => $this->rsvp_responded_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'party' => new Party($this->whenLoaded('party'))
        ];
    }
}
