<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class TransactionResource extends JsonResource
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
                "id" => $this->id,
                "from" => new UserResource($this->from_user),
                "to" => new UserResource($this->to_user),
                "points" => $this->points,
                "cause" => $this->cause,
                "created_at" => (string)$this->created_at
        ];
    }
}
