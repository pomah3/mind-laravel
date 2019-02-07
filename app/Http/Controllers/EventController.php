<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\EventMade;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view("event.index", [
            "events" => Event::all()->filter(function ($e) {
                return $e->author_id == Auth::user()->id ||
                      $e->users->contains(Auth::user());
            })
        ]);
    }

    public function create()
    {
        $this->authorize("create", Event::class);
        return view("event.create");
    }

    public function store(Request $request)
    {
        $this->authorize("create", Event::class);
        $data = $request->validate([
            "title"       => "required",
            "description" => "required",
            "from_date"   => "required|date",
            "till_date"   => "required|date",
            "users.*"     => "required|exists:users,id"
        ]);

        $event = new Event;

        $event->author_id   = Auth::user()->id;
        $event->title       = $data["title"];
        $event->description = $data["description"];
        $event->from_date   = $data["from_date"];
        $event->till_date   = $data["till_date"];

        $event->save();

        foreach ($data["users"] as $user_id) {
            $event->users()->attach($user_id);
        }

        event(new EventMade($event));

        return redirect("/events");
    }

    public function show(Event $event)
    {
        $this->authorize("view", $event);
        return view("event.show", ["event" => $event]);
    }

    public function edit(Event $event)
    {
        $this->authorize("update", $event);
        return view("event.edit", ["event" => $event]);
    }

    public function update(Request $request, Event $event)
    {
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

    public function destroy(Event $event)
    {
        $this->authorize("delete", $event);
        $event->delete();
        return "";
    }
}
