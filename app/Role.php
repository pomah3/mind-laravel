<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Role extends Model {
	public static function has_complex_role(?User $user, $complex_role) {
        if ($complex_role === "all")
            return true;

        if ($complex_role === "logined")
            return $user !== null;

        if (is_string($complex_role))
            return $user !== null && $user->has_role($complex_role);

        if (is_array($complex_role)) {
            if (count($complex_role) == 1)
                return static::has_complex_role($user, $complex_role[0]);

            if ($complex_role[0] === "not")
                return !static::has_complex_role($user, $complex_role[1]);

            if ($complex_role[0] === "and") {
                for ($i=1; $i < count($complex_role); $i++) {
                    if (!static::has_complex_role($user, $complex_role[$i]))
                        return false;
                }

                return true;
            }

            if ($complex_role[0] === "or") {
                for ($i=1; $i < count($complex_role); $i++) {
                    if (static::has_complex_role($user, $complex_role[$i]))
                        return true;
                }

                return false;
            }

            if ($complex_role[0] === "can") {
                return Gate::forUser($user)->allows(...array_slice($complex_role, 1));
            }
        }

        return null;
    }
}
