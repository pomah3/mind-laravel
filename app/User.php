<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function get_name(string $format = "fm gi ft"): string {
		$search = ["gi", "ft", "fm"];
		$replace = [$this->given_name, $this->father_name, $this->family_name];

		return str_replace($search, $replace, $format);
	}

    public function roles() {
        return $this->hasMany(Role::class);
    }

    public function has_role(string $role): bool {
        if ($role === "student")
            return $this->type === "student";

        if ($role === "teacher")
            return $this->type === "teacher";

        return $this->roles->where("role", $role)->count() > 0;
    }

    public function get_role_arg(string $role): string {
        return $this->roles->where("role", $role)->first()->role_arg ?? "";
    }

    public function add_role(string $role_name, string $role_arg = null) {
        $role = new Role;
        $role->user_id = $this->id;
        $role->role = $role_name;
        $role->role_arg = $role_arg;

        $role->save();
    }

    public function student() {
        return new Student($this);
    }

    public static function of_group($group) {
        $roles = Role::where("role", "student")->where("role_arg", $group)->get();
        $users = [];
        foreach($roles as $role) {
            $users[] = User::find($role->user_id);
        }

        return $users;
    }
}
