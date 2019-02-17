@php
    $tr = \App\Transaction::find($notification->data["transaction"]["id"]);
@endphp

<div class="from-name">
    @if ($tr->from_user)
        @user(["user"=>$tr->from_user]),
    @endif
    {{ $tr->created_at }}
</div>

@if ($tr->points > 0)
    <span class="points good-points">
        +{{ $tr->points }}
    </span>
    <div class="cause">
        {{ $tr->cause->title }}
    </div>
@else
    <span class="points bad-points">
        {{ $tr->points }}
    </span>
    <div class="cause">
        {{ $tr->cause->title }}
    </div>
@endif
