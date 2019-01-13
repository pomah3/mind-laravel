@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="info">
        {{ __("user.show.name") }}: {{ $user->get_name() }} <br>
        @if ($user->type === "student")
            {{ __('user.show.balance') }}: {{ App\Transaction::get_balance($user) }}<br>
            {{ __('user.show.group') }}: {{ $user->student()->get_group() }}<br>
        @endif
    </div>
    <hr>
    <div class="notifications">
        @foreach ($user->notifications as $n)
            @component($n->data['view'], [
                "notification" => $n
            ])
            @endcomponent
        @endforeach
    </div>
@endsection
