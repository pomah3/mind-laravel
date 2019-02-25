@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.give.title") }}
@endsection

@section('content')
    @if ($has_login)
        <table>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson["name"] }}</td>
                        @foreach ($lesson["marks"] as $mark)
                            <td>{{ $mark }}</td>
                        @endforeach
                        <td>{{ $lesson["need"] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Сорри, у тебя нет логина еду татар
    @endif
@endsection
