<?php

namespace App\Http\Controllers;

use App\Actions\Events\UpdateEvent;
use App\Event;
use App\Events\EventMade;
use App\Http\Requests\EventRequest;
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
            "events" => Auth::user()->events
        ]);
    }

    private function get_user_variants() {
        return collect($this->user_select->get_variants())
            ->map(function($var) {
                return [
                    "name" => $var["title"],
                    "value" => json_encode($var)
                ];
            });
    }

    public function create() {
        $this->authorize("create", Event::class);

        return view("event.create", [
            "variants" => $this->get_user_variants()
        ]);
    }

    public function store(EventRequest $request) {
        $this->authorize("create", Event::class);

        $users = collect();

        $builder = new UpdateEvent();
        $event = $builder
            ->from_request($request)
            ->author(Auth::user())
            ->users($request->get_users())
            ->update();

        return redirect()->action("EventController@show", ["event" => $event]);
    }

    public function show(Event $event) {
        $this->authorize("view", $event);
        return view("event.show", ["event" => $event]);
    }

    public function edit(Event $event) {
        $this->authorize("update", $event);
        return view("event.edit", [
            "event" => $event,
            "variants" => $this->get_user_variants()
        ]);
    }

    public function update(EventRequest $request, Event $event) {
        $this->authorize("update", $event);

        $builder = new UpdateEvent($event);
        $builder
            ->from_request($request)
            ->users($request->get_users())
            ->update();

        return redirect()->action("EventController@show", ["event" => $event]);
    }

    public function destroy(Event $event) {
        $this->authorize("delete", $event);
        $event->delete();
        return "";
    }
}
