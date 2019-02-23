<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            "lesson" => $this->lesson,
            "weekday" => $this->weekday,
            "time_from" => (string) $this->time_from,
            "time_until" => (string) $this->time_until,
            "number" => $this->number
        ];
    }
}
