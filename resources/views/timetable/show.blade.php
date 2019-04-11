@extends('layout.logined')

@section('title')
    {{ __('timetable.show.title') }}
@endsection

@section('content')
    <div class="container">
        @foreach($days as $day)
            <div class="one-day">
                <h3>{{ __("days.".$day) }}</h3>
                <table class="timetable-table">
                    @foreach($lessons_by_day[$day] as $lesson)
                        <tr>
                            <td>
                                {{ $lesson->get_title() }}
                            </td>
                            <td>
                                {{ $lesson->get_start()->format("H:i") }}
                            </td>
                            <td>
                                {{ $lesson->get_end()->format("H:i") }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>
@endsection
