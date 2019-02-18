@php
    // $tr = \App\Transaction::find($notification->data["transaction"]["id"]);
    $tr = $notification->data["transaction"];
    $cause = \App\Cause::find($tr["cause_id"]);
@endphp

<div class="from-name">
    @if ($tr["from_id"])
        @user(["user"=>\App\User::find($tr["from_id"])]),
    @endif
    {{ $tr["created_at"] }}
</div>

@if ($tr["points"] > 0)
    <span class="points good-points">
        +{{ $tr["points"] }}
    </span>
    <div class="cause">
        {{ $cause->title }}
    </div>
@else
    <span class="points bad-points">
        {{ $tr["points"] }}
    </span>
    <div class="cause">
        {{ $cause->title }}
    </div>
@endif
