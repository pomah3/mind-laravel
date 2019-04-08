<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Utils;
use App\Excel\Formatter;

class UserController extends Controller
{
    public function show(User $user) {
        return view("user.show", ["user"=>$user]);
    }

    public function index() {
        $this->authorize("view", User::class);
        return view("user.index", ["users" => User::all()]);
    }

    public function create() {
        $this->authorize("create", User::class);
        return view("user.create");
    }

    public function store(Request $request) {
        $this->authorize("create", User::class);

        $data = $request->validate([
            "given_name"  => "required",
            "father_name" => "required",
            "family_name" => "required",

            "type"  => ["required", Rule::in(["student", "teacher"])],
            "group" => "required_if:type,student"
        ]);

        $user = new User();
        $user->given_name  = Formatter::name($data["given_name"] );
        $user->father_name = Formatter::name($data["father_name"]);
        $user->family_name = Formatter::name($data["family_name"]);

        $user->type     = $data["type"];
        $user->password = Utils::generate_password();

        $user->save();

        if ($user->type == "student")
            $user->add_role("student", Formatter::group($data["group"]));

        return redirect("/users/" . $user->id);
    }

    public function edit(User $user) {
        $this->authorize("update", $user);
        return view("user.edit", ["user" => $user]);
    }

    public function update(Request $request, User $user) {
        $this->authorize("update", $user);

        $data = $request->validate([
            "given_name"  => "required",
            "father_name" => "required",
            "family_name" => "required",
            "password"    => "required",
        ]);

        $user->given_name  = Formatter::name($data["given_name"] );
        $user->father_name = Formatter::name($data["father_name"]);
        $user->family_name = Formatter::name($data["family_name"]);

        $user->password = $data["password"];

        $user->save();

        return redirect("/users/" . $user->id);
    }

    public function destroy(User $user) {
        $user->roles()->delete();
        $user->delete();
        return "";
    }

    public function setRoles(Request $request, User $user) {
        $request->validate([
            "roles" => "required|json"
        ]);

        $roles = json_decode($request->roles, true);
        $user->roles()->delete();

        foreach ($roles as $role) {
            $user->add_role($role["name"], $role["arg"] ?? null);
        }
    }

    public function verify_email(Request $request, User $user, string $email) {
        if (!$request->hasValidSignature())
            abort(403);

        $user->email = $email;
        $user->email_verified_at = now();
        $user->save();

        return redirect("/")->with('status', "email_verified");
    }
}
