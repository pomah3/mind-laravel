<div class="one-notif {{ $notification->read() ? "read-notification" : "unread-notification" }}">
    @php
        $from_id = $notification->data["transaction"]["from_id"];
        $time = $notification->data["transaction"]["created_at"];
        $cause = $notification->data["transaction"]["cause_id"];
        $points = $notification->data["transaction"]["points"];
    @endphp
    <div class="from-name">
        {{ $from_id }}, {{ $time }}
    </div>
    @if ($points > 0)
        <span class="points good-points">
            +{{ $points }}
        </span>
        <div class="cause">
            {{ $cause }}
        </div>
    @else
        <span class="points bad-points">
            {{ $points }}
        </span>
        <div class="cause">
            {{ $cause }}
        </div>
    @endif
    {{-- {{ var_dump($notification->data) }} --}}
</div>
