<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token', "created_at", "updated_at", "edu_tatar_login", "edu_tatar_password"
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

    public function events() {
        return $this->belongsToMany(Event::class);
    }

    public function status() {
        return $this->hasOne(Status::class)->withDefault([
            "title" => "unknown"
        ]);
    }

    public function scopeStudents($query) {
        return $query->where("type", "student");
    }

    public function scopeTeachers($query) {
        return $query->where("type", "teacher");
    }
}
