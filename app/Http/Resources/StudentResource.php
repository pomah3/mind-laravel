<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->type != "student")
            throw new \Exception("not student");

        $arr = parent::toArray($request);
        $arr["group"] = $this->roles->where("role", "student")->first()->role_arg;

        return $arr;
    }
}
