@extends('layout.logined')

@php($user = Auth::user())
@php($days = ["Monday", "Tuesday", "Wednesday", "Thirsday", "Friday", "Saturday"])

@section('title')
    Timetable
@endsection

@section('content')
    {{ $group }}
    @foreach($days as $day)
        <table>
            <tr>
                <th>
                    {{ __("days.".$day) }}
                </th>
            </tr>
            @foreach($lessons[$day] as $lesson)
                <tr>
                    <td>
                        {{ $lesson->number }}
                    </td>
                    <td>
                        {{ $lesson->lesson }}
                    </td>
                    <td>
                        {{ $lesson->cabinet }}
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
    @endforeach
@endsection
