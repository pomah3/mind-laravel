@extends('layout.logined')

@section('title')
    {{ __('main.profile.title') }}
@endsection

@section('content')
    <div class="container">
        <div class="block-information profile-information">
            <h2>{{ __($daytime) }}, {{ $user_name }}</h2>
            <h3>
                {{ __('profile.info.login') }}: <strong>{{ $user->id }}</strong>
                @if ($user->edu_tatar_login)
                    <h3>{{ __('profile.info.lodin_edu') }}: <strong>{{ $user->edu_tatar_login }}</strong></h3>
                @endif
            </h3>
            @if ($user->has_role("student"))
                <h2>
                    {{ __('profile.info.balance') }}: <strong>
                        {{ $user->student()->get_balance() }}
                    </strong>
                </h2>
                <h3>
                    {{ __('profile.info.group') }}: <strong>
                        {{ $user->student()->get_group() }}
                    </strong>
                </h3>
                <h3>
                    @if ($user->student()->get_classruk())
                        {{ __('profile.info.group_teacher') }}: <strong>
                            @user(["user" => $user->student()->get_classruk()])
                        </strong>
                    @endif
                </h3>
            @endif
        </div>
        <div class="block-information timetable">
            <h2>
                {{ $today_or_tommorow }}:
                <strong>{{ __("days.".$date->format('l')) }}</strong>
            </h2>
            @if (filled($timetable))
                <table class="timetable-table">
                    <tr>
                        <th></th>
                        <th>{{ __('profile.timetable.subject') }}</th>
                        <th>{{ __('profile.timetable.time') }}</th>
                    </tr>
                    @php
                        $last = -1;
                    @endphp
                    @foreach ($timetable as $lesson)
                        <tr class="{{ $is_now($lesson) ? "lesson-now" : ""}}">
                            <td>{{ $lesson->number }}</td>
                            <td>{{ $lesson->lesson  }}</td>
                            <td>{{ $lesson->time_from->format("H:i") }} - {{ $lesson->time_until->format("H:i") }}</td>
                        </tr>
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
