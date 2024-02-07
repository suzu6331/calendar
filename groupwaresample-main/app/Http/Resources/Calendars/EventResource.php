<?php

namespace App\Http\Resources\Calendars;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'description' => $this->description,
            'start' => $this->start_time?->format('Y-m-d\TH:i:s\Z'),
            'end' => $this->end_time?->format('Y-m-d\TH:i:s\Z'),
            'allDay' => $this->all_day_flag,
            'data' => [
                'register' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ],
            ],
            'backgroundColor' => $this->when($this->user->calendar_background, $this->user->calendar_background),
            'borderColor' => $this->when($this->user->calendar_bordercolor, $this->user->calendar_bordercolor),
            'textColor' => $this->when($this->user->calendar_textcolor, $this->user->calendar_textcolor),
            'eventMembers' => $this->whenLoaded('eventMembers', function(){
                return EventMemberResource::collection($this->eventMembers);
            }),
        ];
    }
}
