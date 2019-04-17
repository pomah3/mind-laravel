<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableItemResource extends JsonResource {
    public function toArray($request) {
        return [
            "title" => $this->get_title(),
            "start" => (string)$this->get_start(),
            "end" => (string)$this->get_end(),
        ];
    }
}
