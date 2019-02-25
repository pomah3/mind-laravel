@extends('layout.logined')

@php($user = Auth::user())
@php($days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"])

@section('title')
    Timetable
@endsection

@section('content')
    <div class="container">
        @foreach($days as $day)
            <div class="one-day">
                <h3>{{ __("days.".$day) }}</h3>
                <table class="timetable-table">
                    @foreach($lessons[$day] as $lesson)
                        <tr>
                            <td>
                                {{ $lesson->number }}
                            </td>
                            <td>
                                {{ $lesson->lesson }}
                            </td>
                            <td>
                                {{ $lesson->time_from }}
                            </td>
                            <td>
                                {{ $lesson->time_until }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>
@endsection
