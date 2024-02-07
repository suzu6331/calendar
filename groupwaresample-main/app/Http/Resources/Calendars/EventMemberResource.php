<?php

namespace App\Http\Resources\Calendars;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user_id,
            'name' => $this->user->name,
        ];
    }
}
