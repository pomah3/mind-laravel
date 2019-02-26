@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.give.title") }}
@endsection

@section('content')
    <div class="container container-points">
        @if ($has_login)
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td><strong>Предмет</strong></td>
                        <td><strong>Оценки</strong></td>
                        <td><strong>Количество оценок до 4,50</strong></td>
                    </tr>
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
    </div>
@endsection
