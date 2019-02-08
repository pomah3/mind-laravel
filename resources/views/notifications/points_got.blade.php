<div class="one-notif">
    <div class="from-name">
        @php
            $points = $notification->data["transaction"]["points"];
        @endphp
    </div>
    <div class="cause">
        @if ($points > 0)
            <span class="points good-points">
                {{ trans_choice("notifications.points_got.plus", $points) }}
            </span>
        @else
            <span class="points bad-points">
                {{ trans_choice("notifications.points_got.minus", -$points) }}
            </span>
        @endif
    </div>
</div>
