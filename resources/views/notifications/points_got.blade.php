<div>
    @php
        $points = $notification->data["transaction"]["points"];
    @endphp

    @if ($points > 0)
        {{ trans_choice("notifications.points_got.plus", $points) }}
    @else
        {{ trans_choice("notifications.points_got.minus", -$points) }}
    @endif
</div>
