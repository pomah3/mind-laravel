@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    Профиль
@endsection

@section('content')
    <div class="container">
        <div class="block-information profile-information">
            <h2>{{ $daytime }}, @user(["user"=>$user])</h2>
            @if ($user->has_role("student"))
                <h2>
                    Баланс: <strong>
                        {{ $user->student()->get_balance() }}
                    </strong>
                </h2>
                <h3>
                    Логин: <strong>{{ $user->id }}</strong> <br>
                    @if ($user->edu_tatar_login)
                        Логин edu.tatar.ru: <strong>{{ $user->edu_tatar_login }}</strong>
                    @endif
                </h3>
                <h3>
                    Класс: <strong>
                        {{ $user->student()->get_group() }}
                    </strong>
                </h3>
                <h3>
                    Классный руководитель: <strong>
                        @user(["user" => $user->student()->get_classruk()])
                    </strong>
                </h3>
            @endif
        </div>
        <div class="block-information timetable">
            <h2>
                {{ Carbon\Carbon::now()->format("l") == $date->format("l") ? "Сегодня" : "Завтра"}}:
                <strong>{{ $date->format("l") }}</strong>,
                {{ $date->format("d.m.Y") }}
            </h2>
            @if (isset($timetable))
                <table class="timetable-table">
                    <tr>
                        <th></th>
                        <th>Предмет</th>
                        <th>Каб.</th>
                    </tr>
                    @foreach ($timetable as $lesson)
                        <tr class="{{ $lesson->is_now ? "lesson-now" : ""}}">
                            <td>{{ $lesson->number  }}</td>
                            <td>{{ $lesson->lesson  }}</td>
                            <td>{{ $lesson->cabinet }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        <div class="notifications">
            @foreach ($user->notifications as $n)
                @component($n->data['view'], [
                    "notification" => $n
                ])
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection
