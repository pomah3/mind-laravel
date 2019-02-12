@extends('layout.logined')

@php
    $user = Auth::user();
@endphp

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
                    Логин: <strong>{{ $user->id }}</strong>
                    @if ($user->edu_tatar_login)
                        <h3>Логин edu.tatar.ru: <strong>{{ $user->edu_tatar_login }}</strong></h3>
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
                        <th>Время</th>
                    </tr>
                    @php
                        $last = -1;
                    @endphp
                    @foreach ($timetable as $lesson)
                        <tr class="{{ $lesson->is_now ? "lesson-now" : ""}}">
                            <td>{{ $last == $lesson->number ? "" : $lesson->number  }}</td>
                            <td>{{ $lesson->lesson  }}</td>
                            <td>{{ $lesson->time_from->format("H:i") }} - {{ $lesson->time_until->format("H:i") }}</td>
                        </tr>
                        @php
                            $last = $lesson->number;
                        @endphp
                    @endforeach
                </table>
            @endif
        </div>
        <div class="notifications">
            @foreach ($user->notifications as $n)
                @notification(["notification" => $n])
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            $(".unread-notification").mouseover(function() {
                let that = this;

                if ($(that).hasClass("read-notification"))
                    return;

                let id = $(that).attr("notif-id");
                $.ajax({
                    "url": "/notifications/" + id + '/read',
                    "method": "PUT"
                }).done(function() {
                    $(that).removeClass("unread-notification");
                    $(that).addClass("read-notification");
                });
            });
        </script>
    @endpush

@endsection
