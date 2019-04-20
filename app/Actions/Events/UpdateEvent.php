<?php

namespace App\Actions\Events;

use App\Event;
use App\Events\EventMade;
use App\Http\Requests\EventRequest;
use App\User;
use Carbon\Carbon;

class UpdateEvent {
    private $users;
    private $event;

    public function __construct(?Event $event=null) {
        $this->event = $event ?? new Event();
        $this->users = collect();
    }

    public function event(Event $event) {
        $this->event = $event;
        return $this;
    }

    public function author(User $user) {
        $this->event->author_id = $user->id;
        return $this;
    }

    public function title(string $title) {
        $this->event->title = $title;
        return $this;
    }

    public function description(string $description) {
        $this->event->description = $description;
        return $this;
    }

    public function from_date(Carbon $from_date) {
        $this->event->from_date = $from_date;
        return $this;
    }

    public function till_date(Carbon $till_date) {
        $this->event->till_date = $till_date;
        return $this;
    }

    public function users($users) {
        $this->users = collect($users)
            ->map(function($a) {
                return $a->id;
            });

        return $this;
    }

    public function update() {
        $author_id = $this->event->author_id;

        $first_time = !$this->event->id;
        $users = $this->users->merge([$author_id]);

        $this->event->save();
        $this->event->users()->sync($users);

        if ($first_time)
            event(new EventMade($this->event));

        return $this->event;
    }

    public function from_request(EventRequest $request) {
        $this
            ->title($request->title)
            ->description($request->description)
            ->from_date(new Carbon($request->from_date))
            ->till_date(new Carbon($request->till_date));

        return $this;
    }
}
