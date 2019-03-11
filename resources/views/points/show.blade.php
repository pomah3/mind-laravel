@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.show.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Баланс: <strong>{{ $student->student()->get_balance() }}</strong> баллов</h2>

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
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
