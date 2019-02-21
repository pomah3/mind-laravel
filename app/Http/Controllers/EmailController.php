<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;
use App\User;
use App\Role;

class EmailController extends Controller
{
    public function index() {
        $this->authorize("send-email");
        return view("email.index");
    }

    public function send(Request $request) {
        $this->authorize("send-email");

        $data = $request->validate([
            "access" => "required|json",
            "text" => "required"
        ]);

        $role = json_decode($data["access"]);

        $users = User::whereNotNull("email")
                     ->get()
                     ->filter(function($a) use ($role) {
                         return Role::has_complex_role($a, $role);
                     });

        Mail::to($users)->send(new CustomMail($data["text"]));
    }

    public function preview(Request $request) {
        $this->authorize("send-email");

        $data = $request->validate([
            "text" => "required"
        ]);

        return new CustomMail($data["text"]);
    }
}
