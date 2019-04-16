@extends('layout.logined')

@php
    $user = Auth::user();
@endphp

@section('title')
    {{ __("points.show.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>{{ __('points.give.balance') }}: <strong>{{ $student->student()->get_balance() }}</strong> {{ trans_choice('group.table.points', $student->student()->get_balance()) }}</h2>

        @foreach ($days as $day)
            <h3>{{ $day["date"]->format("d.m.Y") }}</h3>

            @foreach ($day["transactions"] as $tr)
                <div class="day">
                    <h3 class="date">

                    </h3>
                    <div class="transaction">
                        <div class="from-name">
                            @if ($tr->from_user)
                                @user(["user" => $tr->from_user]) в
                            @endif
                            <span class="transaction-time">
                                {{ $tr->created_at->format("H:i") }}
                            </span>
                        </div>

                        @php
                            if ($tr->from_id == $user->id)
                                $tr->points *= -1;
                        @endphp

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

                        @can('remove-transaction', $tr)
                            <button class="remove-tr submit" tr-id="{{ $tr->id }}">Отменить</button>
                        @endcan
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

@push('scripts')
    <script>
        $(".remove-tr").click(function() {
            let that = this;
            let id = $(that).attr("tr-id");

            $.ajax({
                method: "DELETE",
                url: "/transactions/" + id,
            })
            .done(function() {
                location.reload();
            });
        });
    </script>
@endpush
@endsection
