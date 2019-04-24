@extends('layout.logined')

@section('title')
    {{ __('event.create.title') }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Редактировать мероприятие</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/events/{{ $event->id }}" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf
            @method("PUT")

            <label for="title">{{ __('event.about.name') }}:</label>
            <input
                type="text"
                name="title"
                class="form-control"
                placeholder="{{ __('event.placeholder.name') }}"
                value="{{ $event->title }}"
            >

            <label for="description">{{ __('event.about.description') }}:</label>
            <input
                type="text"
                name="description"
                class="form-control"
                placeholder="{{ __('event.placeholder.description') }}"
                value="{{ $event->description }}"
            >

            <label for="from_date">{{ __('event.about.from_date') }}:</label>
            <input
                type="datetime-local"
                name="from_date"
                class="form-control"
                value="{{ $event->from_date->format("Y-m-d\TH:i:s") }}"
            >

            <label for="till_date" id="for_is">{{ __('event.about.till_date') }}:</label>
            <input
                type="datetime-local"
                id="till_date"
                name="till_date"
                class="form-control"
                value="{{ $event->till_date->format("Y-m-d\TH:i:s") }}"
            >

            <label for="responsible">{{ __('event.about.responsible') }}:</label>

            @php
                $users_ = App\User::all()->map(function($user) use ($event) {
                    return [
                        "name" => $user->get_name(),
                        "value" => $user->id,
                        "selected" => $user->id == $event->responsible_id
                    ];
                })->values();
            @endphp

            <single-select
                name="responsible"
                :variants='@json($users_)'
                placeholder="Начните вводить имя"
            ></single-select>

            <label for="user_select">{{ __('event.about.user_select') }}:</label>

            @php
                $def = $event->users->map(function($user) {
                    $a = [
                        "title" => $user->get_name(),
                        "type" => "id",
                        "id" => $user->id,
                    ];

                    return json_encode($a);
                });
            @endphp

            <multiple-select
                :variants='@json($variants)'
                name="users"
                placeholder="Начните вводить имя, класс или параллель"
                :default-select='@json($def)'
                >
            </multiple-select>

            <input type="submit" class="submit" value="{{ __('main.submit.send') }}">

        </form>
    </div>
@endsection
