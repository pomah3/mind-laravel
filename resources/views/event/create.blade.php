@extends('layout.logined')

@section('title')
    {{ __('event.create.title') }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Создать мероприятие</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/events" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf
            <label for="title">{{ __('event.about.name') }}:</label>
            <input type="text" name=    "title" class="form-control" required placeholder="{{ __('event.placeholder.name') }}">

            <label for="description">{{ __('event.about.description') }}:</label>
            <input type="text" name="description" class="form-control" required placeholder="{{ __('event.placeholder.description') }}">

            <label for="from_date">{{ __('event.about.from_date') }}:</label>
            <input type="datetime-local" name="from_date" class="form-control" required>

            <label for="till_date" id="for_is">{{ __('event.about.till_date') }}:</label>
            <input type="datetime-local" id="till_date" name="till_date" class="form-control" required>

            <label for="responsible">{{ __('event.about.responsible') }}:</label>

            @php
                $users_ = $users->map(function($user) {
                    return [
                        "name" => $user->get_name(),
                        "value" => $user->id,
                        "selected" => $user->id == Auth::user()->id
                    ];
                })->values();
            @endphp

            <single-select
                name="responsible"
                :variants='@json($users_)'
                placeholder="Начните вводить имя"
            ></single-select>

            <label for="user_select">{{ __('event.about.user_select') }}:</label>
            <multiple-select
                :variants='@json($variants)'
                name="users"
                placeholder="Начните вводить имя, класс или параллель"
                >
            </multiple-select>

            <input type="submit" class="submit user-select-submit" value="{{ __('main.submit.send') }}">

        </form>
    </div>
@endsection
