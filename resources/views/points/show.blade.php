@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.show.title") }}
@endsection

@section('content')
    <h1>{{ $student->get_name() }}</h1>

    <table>
        <tr>
            <th>Время</th>
            <th>Баллы</th>
            <th>От кого</th>
            <th>Кому</th>
            <th>Причина</th>
        </tr>

        @foreach ($transactions as $tr)
            <tr>
                <td>{{ $tr->created_at }}</td>
                <td>{{ $tr->points }}</td>
                <td>{{ $tr->from_id }}</td>
                <td>{{ $tr->to_id }}</td>
                <td>{{ $tr->cause }}</td>
            </tr>
        @endforeach
    </table>
@endsection
