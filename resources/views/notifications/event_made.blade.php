@php
    $data = $notification->data["event"];

    $url = "";
    $event = App\Event::find($data["id"]);
    if ($event)
        $url = URL::action("EventController@show", ["event" => $event]);

    $title = __('notifications.event', [
        "event" => "<a href='$url'>".$data["title"]."</a>"
    ]);

@endphp

<div class="cause">
    {!! $title !!}
</div>
