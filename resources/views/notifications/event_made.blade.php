@php
    $data = $notification->data["event"];

    $url = "";
    $event = App\Event::find($data["id"]);
    if ($event)
        $url = URL::action("EventController@show", ["event" => $event]);

@endphp

<div class="cause">
    {{ __('notifications.event') }} "<a href="{{ $url }}">{{ $data["title"] }}</a>"
</div>
