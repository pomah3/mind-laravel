<div class="one-notif {{ $notification->read() ? "read-notification" : "unread-notification" }}" notif-id="{{ $notification->id }}">
    @component($notification->data['view'], [
            "notification" => $n
        ])
    @endcomponent
</div>
