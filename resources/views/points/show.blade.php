@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.show.title") }}
@endsection

@section('content')
    <h1>{{ $student->get_name() }}</h1>

    Баланс: {{ $student->student()->get_balance() }}

    <table>
        <tr>
            <th>{{ __("points.show.time") }}</th>
            <th>{{ __("points.show.points") }}</th>
            <th>{{ __("points.show.from") }}</th>
            <th>{{ __("points.show.to") }}</th>
            <th>{{ __("points.show.cause") }}</th>
        </tr>

        @foreach ($transactions as $tr)
            <tr>
                <td>{{ $tr->created_at }}</td>
                <td>{{ $tr->points }}</td>
                @if ($tr->from_user)
                    <td>@user(["user"=>$tr->from_user])</td>
                @else
                    <td></td>
                @endif
                <td>@user(["user"=>$tr->to_user])</td>
                <td>{{ $tr->cause->title }}</td>
            </tr>
        @endforeach
    </table>
@endsection
