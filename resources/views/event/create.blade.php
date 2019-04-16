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
            <input type="text" name="title" class="form-control" placeholder="{{ __('event.placeholder.name') }}">
            <label for="description">{{ __('event.about.description') }}:</label>
            <input type="text" name="description" class="form-control" placeholder="{{ __('event.placeholder.description') }}">
            <label for="from_date">{{ __('event.about.from_date') }}:</label>
            <input type="datetime-local" name="from_date" class="form-control">
            <label for="till_date" id="for_is">{{ __('event.about.till_date') }}:</label>
            <input type="datetime-local" id="till_date" name="till_date" class="form-control">

            <multiple-select :variants='@json($variants)' name="users"></multiple-select>

            <input type="submit" class="submit" value="{{ __('main.submit.send') }}">

        </form>
    </div>
@endsection
