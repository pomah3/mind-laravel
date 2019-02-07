<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    private $except = [
        "created_at", "updated_at"
    ];

    public function toArray($request)
    {
        $arr = parent::toArray($request);

        $arr["id"] = (string)$arr["id"];

        foreach ($this->except as $key) {
            unset($arr[$key]);
        }

        $arr["roles"] = [];
        foreach ($this->roles as $role) {
            if ($role->role === "student")
                continue;

            $arr["roles"][] = [
                "role" => $role->role,
                "role_arg" => $role->role_arg
            ];
        }

        if ($this->type == "student") {
            $arr["group"] = $this->roles->where("role", "student")->first()->role_arg;
            $arr["points"] = User::find($this->id)->student()->get_balance();
        }

        return $arr;
    }
}
