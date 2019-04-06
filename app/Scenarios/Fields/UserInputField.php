<?php

namespace App\Scenarios\Fields;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserInputField implements InputField {
    private $name;
    private $label;
    private $users;
    private $user = null;

    public function __construct(string $name, string $label, $filter) {
        $this->name = $name;
        $this->label = $label;

        if (is_array($filter)) {
            $f = $filter;
            $filter = function($user) use ($f) {
                return Role::has_complex_role($user, $f);
            };
        }

        $this->users = User::all()->filter($filter);
    }

    public function get_html() {
        return view("scenario.fields.user", [
            "name" => $this->name,
            "label" => $this->label,
            "users" => $this->users
        ]);
    }

    public function set_value(Request $r) {
        $id = $r->all()[$this->name];
        $this->user = User::find($id);

        if ($this->user == null)
            abort(400);
    }

    public function get_user() {
        return $this->user;
    }
}
