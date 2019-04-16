<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\EventMade;
use App\Services\UserSelectService;
use App\User;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller {
    private $user_select;

    public function __construct(UserSelectService $user_select) {
        $this->middleware("auth");
        $this->user_select = $user_select;
    }

    public function index() {
        return view("event.index", [
            "events" => Event::all()->filter(function ($e) {
                return Auth::user()->can("view", $e);
            })
        ]);
    }

    public function create() {
        $this->authorize("create", Event::class);

        $variants = collect($this->user_select->get_variants())
            ->map(function($var) {
                return [
                    "name" => $var["title"],
                    "value" => json_encode($var)
                ];
            });

        return view("event.create", [
            "variants" => $variants
        ]);
    }

    public function store(Request $request) {
        $this->authorize("create", Event::class);
        $data = $request->validate([
            "title"       => "required",
            "description" => "required",
            "from_date"   => "required|date",
            "till_date"   => "required|date",
            "users.*"     => "required"
        ]);

        $event = new Event;

        $event->author_id   = Auth::user()->id;
        $event->title       = $data["title"];
        $event->description = $data["description"];
        $event->from_date   = new Carbon($data["from_date"]);
        $event->till_date   = new Carbon($data["till_date"]);

        $event->save();

        $users = collect();

        foreach ($data["users"] as $user_raw) {
            $user_raw = json_decode($user_raw, true);
            $user_raw = $this->user_select->get_users($user_raw);
            $users = $users->merge($user_raw);
        }

        foreach ($users as $user) {
            $event->users()->attach($user->id);
        }

        event(new EventMade($event));

        return redirect("/events");
    }

    public function show(Event $event) {
        $this->authorize("view", $event);
        return view("event.show", ["event" => $event]);
    }

    public function edit(Event $event) {
        $this->authorize("update", $event);
        return view("event.edit", ["event" => $event]);
    }

    public function update(Request $request, Event $event) {
        $this->authorize("update", $event);
        $data = $request->validate([
            "title"       => "required",
            "description" => "required",
            "from_date"   => "required|date",
            "till_date"   => "required|date",
            "users.*"     => "required|exists:users,id"
        ]);

        $event->title       = $data["title"];
        $event->description = $data["description"];
        $event->from_date   = $data["from_date"];
        $event->till_date   = $data["till_date"];

        $event->save();

        foreach ($data["users"] as $user_id) {
            $event->users->attach($user_id);
        }

        return redirect("/events");
    }

    public function destroy(Event $event) {
        $this->authorize("delete", $event);
        $event->delete();
        return "";
    }
}
